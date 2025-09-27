<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\HasilMonitoring;
use App\Models\Pasien;
use Illuminate\Http\Request;

class HasilMonitoringController extends Controller
{
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
