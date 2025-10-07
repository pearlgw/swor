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
        $tenSecondsAgo = Carbon::now()->subSeconds(20);

        // Ambil satu data monitoring terbaru dalam 10 detik terakhir
        $monitoring = HasilMonitoring::where('created_at', '>=', $tenSecondsAgo)
            ->latest('created_at')
            ->first();

        // Jika tidak ada data yang masih dalam 10 detik, kembalikan kosong
        if (!$monitoring) {
            return response()->json([
                'message' => 'Tidak ada data monitoring terbaru dalam 10 detik terakhir.',
                'data' => null,
            ], 404);
        }

        // Kalau ada, kirim datanya
        return response()->json([
            'message' => 'Data monitoring terbaru ditemukan.',
            'data' => $monitoring,
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
