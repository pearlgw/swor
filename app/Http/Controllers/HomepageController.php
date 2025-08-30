<?php

namespace App\Http\Controllers;

use App\Models\HasilMonitoring;
use App\Models\Pasien;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function download(Request $request)
    {
        $kodePasien = $request->input('kode_pasien');
        $umur = $request->input('umur');
        $month = $request->input('month', now()->format('Y-m'));
        $chartBase64 = $request->input('chart_base64');

        $startDate = Carbon::parse($month . '-01')->startOfMonth();
        $endDate = Carbon::parse($month . '-01')->endOfMonth();

        $pasienQuery = Pasien::query();

        if ($kodePasien) $pasienQuery->where('kode_pasien', $kodePasien);
        if ($umur) $pasienQuery->where('umur', $umur);

        $pasiens = $pasienQuery->get();

        $data = $pasiens->map(function ($pasien) use ($startDate, $endDate, $chartBase64) {
            $monitorings = HasilMonitoring::where('pasien_id', $pasien->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('created_at')
                ->get()
                ->map(function ($m) {
                    $carbon = Carbon::parse($m->created_at);
                    $m->minggu = $carbon->weekOfMonth;
                    return $m;
                });

            return [
                'pasien' => $pasien,
                'monitorings' => $monitorings,
                'chart' => $chartBase64
            ];
        });

        $firstPatientName = $pasiens->first()?->nama ?? 'Unknown';
        $pdf = Pdf::loadView('page_download', ['data' => $data, 'month' => $month]);
        return $pdf->download("Monitoring_" . str_replace(' ', '_', $firstPatientName) . "_" . $month . ".pdf");
    }

    public function getMonitoringData(Request $request)
    {
        $kodePasien = $request->input('kode_pasien');
        $umur = $request->input('umur');
        $month = $request->input('month', now()->format('Y-m'));

        $startDate = Carbon::parse($month . '-01')->startOfMonth();
        $endDate = Carbon::parse($month . '-01')->endOfMonth();

        $pasien = Pasien::query()
            ->when($kodePasien, fn($q) => $q->where('kode_pasien', $kodePasien))
            ->when($umur, fn($q) => $q->where('umur', $umur))
            ->first();

        if (!$pasien) {
            return response()->json(['labels' => [], 'data' => []]);
        }

        $monitorings = HasilMonitoring::where('pasien_id', $pasien->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at')
            ->get()
            ->map(function ($m) {
                $carbon = Carbon::parse($m->created_at);
                return [
                    'minggu' => $carbon->weekOfMonth,
                    'tanggal' => $carbon->format('d-m-Y'),
                    'sudut' => $m->sudut_tangan ?? 0,
                ];
            });

        return response()->json([
            'labels' => $monitorings->map(fn($m) => "Minggu {$m['minggu']} ({$m['tanggal']})"),
            'data'   => $monitorings->map(fn($m) => $m['sudut']),
        ]);
    }
}
