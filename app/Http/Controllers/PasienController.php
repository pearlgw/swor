<?php

namespace App\Http\Controllers;

use App\Models\HasilMonitoring;
use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->is_admin) {
            $query = Pasien::query();
        } else {
            $query = Pasien::query()->where('dokter_id', Auth::id());
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode_pasien', 'like', "%{$search}%");
                // ->orWhere('diagnosa_utama', 'like', "%{$search}%");
            });
        }

        $pasiens = $query->latest()->paginate(10)->withQueryString();

        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        $dokters = User::where('is_admin', false)
            ->latest()->get();
        return view('pasien.create', compact('dokters'));
    }

    public function show(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        // ambil bulan dari input, default bulan sekarang
        $month = $request->input('month', now()->format('Y-m'));

        // range tanggal bulan tsb
        $startDate = Carbon::parse($month . '-01')->startOfMonth();
        $endDate   = Carbon::parse($month . '-01')->endOfMonth();

        // ambil monitoring pasien sesuai bulan
        $monitorings = HasilMonitoring::where('pasien_id', $id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at')
            ->get();

        if ($monitorings->isEmpty()) {
            return view('pasien.show', compact('pasien'))
                ->with([
                    'chartData' => [],
                    'month' => $month,
                ]);
        }

        // ambil tanggal monitoring pertama di bulan tsb → acuan minggu pertama
        $firstDate = $monitorings->min('created_at')->startOfDay();

        // group per minggu relatif terhadap tanggal pertama
        $grouped = $monitorings->groupBy(function ($item) use ($firstDate) {
            $diffWeeks = $firstDate->diffInWeeks($item->created_at);
            return $diffWeeks + 1; // Minggu 1, 2, 3, dst.
        });

        $chartData = [];
        foreach ($grouped as $week => $records) {
            $avgSudut = $records->avg('sudut_tangan');

            $jamMulai = $records->first()->jam_mulai ?? null;
            $jamSelesai = $records->first()->jam_selesai ?? null;
            $createdAt = $records->first()->created_at ?? null;

            $chartData[] = [
                'minggu' => "Minggu $week",
                'sudut' => round($avgSudut, 2),
                'jam_mulai' => $jamMulai,
                'jam_selesai' => $jamSelesai,
                'created_at' => $createdAt,
            ];
        }

        return view('pasien.show', compact('pasien', 'chartData', 'month'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['nullable', 'integer'],
            'metode' => ['nullable', 'string'],
            'diagnosa_utama' => ['nullable', 'string'],
            'tingkat_hemiparese' => ['nullable', 'string'],
            'riwayat_penyakit' => ['nullable', 'string'],
            'tanggal_sakit' => ['nullable', 'date'],
            'tanggal_mulai_terapi' => ['nullable', 'date'],
            'dokter_id' => ['nullable', 'exists:users,id'],
        ]);

        $lastPasien = Pasien::latest('id')->first();
        $nextNumber = $lastPasien ? ((int) substr($lastPasien->kode_pasien, 4)) + 1 : 1;
        $kodePasien = 'PSN-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $dokterId = Auth::user()->is_admin === 0
            ? Auth::id()
            : $request->dokter_id;

        Pasien::create([
            'kode_pasien' => $kodePasien,
            'nama' => $request->nama,
            'umur' => $request->umur,
            'metode' => $request->metode,
            'diagnosa_utama' => $request->diagnosa_utama,
            'tingkat_hemiparese' => $request->tingkat_hemiparese,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'tanggal_sakit' => $request->tanggal_sakit,
            'tanggal_mulai_terapi' => $request->tanggal_mulai_terapi,
            'dokter_id' => $dokterId,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        $dokters = User::where('is_admin', false)
            ->latest()->get();
        return view('pasien.edit', compact('pasien', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['nullable', 'integer'],
            'metode' => ['nullable', 'string'],
            'diagnosa_utama' => ['nullable', 'string'],
            'tingkat_hemiparese' => ['nullable', 'string'],
            'riwayat_penyakit' => ['nullable', 'string'],
            'tanggal_sakit' => ['nullable', 'date'],
            'tanggal_mulai_terapi' => ['nullable', 'date'],
            'dokter_id' => ['nullable', 'exists:users,id'],
        ]);

        $dokterId = Auth::user()->is_admin === 0
            ? Auth::id()
            : $request->dokter_id;

        $pasien->update([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'metode' => $request->metode,
            'diagnosa_utama' => $request->diagnosa_utama,
            'tingkat_hemiparese' => $request->tingkat_hemiparese,
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'tanggal_sakit' => $request->tanggal_sakit,
            'tanggal_mulai_terapi' => $request->tanggal_mulai_terapi,
            'dokter_id' => $dokterId,
        ]);

        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }
}
