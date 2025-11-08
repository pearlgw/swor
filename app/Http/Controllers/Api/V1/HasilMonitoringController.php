<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HasilMonitoring;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HasilMonitoringController extends Controller
{
    public function index()
    {
        // Ambil data terbaru yang mengalami perubahan di 5 field tertentu
        $updatedMonitoring = HasilMonitoring::whereNotNull('last_changed_field')
            ->where('status', 'berlangsung')
            ->where(function ($query) {
                $query->where('last_changed_field', 'LIKE', '%tinggi_shoulder%')
                    ->orWhere('last_changed_field', 'LIKE', '%sudut_tangan%')
                    ->orWhere('last_changed_field', 'LIKE', '%kecepatan%')
                    ->orWhere('last_changed_field', 'LIKE', '%mode%')
                    ->orWhere('last_changed_field', 'LIKE', '%mode_tangan%');
            })
            ->orderByDesc('updated_at')
            ->first();

        // Ambil data terbaru berdasarkan waktu pembuatan
        $latestMonitoring = HasilMonitoring::where('status', 'berlangsung')->latest('created_at')->first();

        // Jika ada update valid di 5 field tertentu, tampilkan itu
        if ($updatedMonitoring && $updatedMonitoring->updated_at > $latestMonitoring->created_at) {
            return response()->json([
                'message' => 'Data monitoring terbaru berdasarkan perubahan field tertentu.',
                'data' => $updatedMonitoring,
            ], 200);
        }

        // Jika tidak ada update di 5 field tersebut, tampilkan data terbaru berdasarkan created_at
        return response()->json([
            'message' => 'Data monitoring terbaru berdasarkan waktu pembuatan.',
            'data' => $latestMonitoring,
        ], 200);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'pasien_id'       => 'required|numeric',
            'tinggi_shoulder' => 'nullable|numeric',
            'sudut_tangan'    => 'nullable|numeric',
            'kecepatan'       => 'nullable|numeric',
            'mode'            => 'nullable|string',
            'mode_tangan'     => 'nullable|string',
        ]);

        // Cek apakah pasien ada
        $pasien = Pasien::where('id', $validated['pasien_id'])->first();
        if (!$pasien) {
            return response()->json([
                'success' => false,
                'message' => 'Pasien tidak ditemukan'
            ], 404);
        }

        // Simpan monitoring baru
        HasilMonitoring::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Monitoring berhasil ditambahkan',
        ], 201);
    }
}
