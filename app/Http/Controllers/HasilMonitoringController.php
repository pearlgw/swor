<?php

namespace App\Http\Controllers;

use App\Models\HasilMonitoring;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class HasilMonitoringController extends Controller
{
    public function index(Request $request)
    {
        $query = HasilMonitoring::with(['pasien', 'user']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('pasien', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('kode_pasien', 'like', "%{$search}%");
            });
        }

        $monitorings = $query->latest()->paginate(10)->withQueryString();

        return view('monitoring.index', compact('monitorings'));
    }

    public function create()
    {
        $pasiens = Pasien::latest()->get();
        $dokters = User::where('email', '!=', 'admin1@gmail.com')
            ->latest()->get();
        return view('monitoring.create', compact('pasiens', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id'          => 'required|exists:pasiens,id',
            'dokter_id'          => 'nullable|exists:users,id',
            'tinggi_shoulder'    => 'nullable|numeric',
            'sudut_tangan'       => 'nullable|numeric',
            'kecepatan'          => 'nullable|numeric',
            'jenis_terapi'       => 'nullable|string|max:255',
            'frekuensi_latihan'  => 'nullable|integer',
            'durasi_sesi'        => 'nullable|integer',
            'jumlah_repetisi'    => 'nullable|integer',
            'sudut_rotasi'       => 'nullable|numeric',
            'catatan'            => 'nullable|string',
            'jam_mulai'          => 'nullable|date_format:H:i',
            'jam_selesai'        => 'nullable|date_format:H:i|after_or_equal:jam_mulai',
            'status'             => 'nullable|string|max:50',
        ]);

        HasilMonitoring::create($request->all());

        return redirect()->route('monitoring.index')
            ->with('success', 'Data monitoring berhasil ditambahkan.');
    }

    public function show($id)
    {
        $monitoring = HasilMonitoring::findOrFail($id);
        return view('monitoring.show', compact('monitoring'));
    }


    public function edit($id)
    {
        $monitoring = HasilMonitoring::findOrFail($id);
        $pasiens = Pasien::latest()->get();
        $dokters = User::where('email', '!=', 'admin1@gmail.com')
            ->latest()->get();
        return view('monitoring.edit', compact('monitoring', 'pasiens', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        // Cari data monitoring berdasarkan ID
        $monitoring = HasilMonitoring::findOrFail($id);

        // Validasi request
        $validated = $request->validate([
            'pasien_id'          => 'required|exists:pasiens,id',
            'dokter_id'          => 'required|exists:users,id',
            'tinggi_shoulder'    => 'nullable|numeric',
            'sudut_tangan'       => 'nullable|numeric',
            'kecepatan'          => 'nullable|numeric',
            'jenis_terapi'       => 'nullable|string|max:255',
            'frekuensi_latihan'  => 'nullable|numeric',
            'durasi_sesi'        => 'nullable|numeric',
            'jumlah_repetisi'    => 'nullable|numeric',
            'sudut_rotasi'       => 'nullable|numeric',
            'catatan'            => 'nullable|string',
            'jam_mulai'          => 'nullable|date_format:H:i',
            'jam_selesai'        => 'nullable|date_format:H:i|after_or_equal:jam_mulai',
            'status'             => 'required|in:selesai,berlangsung,batal',
        ]);

        $monitoring->update($validated);

        return redirect()
            ->route('monitoring.index')
            ->with('success', 'Data monitoring berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $monitoring = HasilMonitoring::findOrFail($id);
        $monitoring->delete();

        return redirect()->route('monitoring.index')->with('success', 'Data monitoring berhasil dihapus.');
    }
}
