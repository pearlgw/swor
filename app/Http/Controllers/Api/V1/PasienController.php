<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function getAllPasien(Request $request)
    {
        $search = $request->query('search');

        if ($search) {
            $pasiens = DB::select(
                "SELECT id, nama, kode_pasien, umur
             FROM pasiens
             WHERE nama LIKE ? OR kode_pasien LIKE ?",
                ["%{$search}%", "%{$search}%"]
            );
        } else {
            $pasiens = DB::select(
                "SELECT id, nama, kode_pasien, umur FROM pasiens"
            );
        }

        return response()->json([
            'success' => true,
            'data' => $pasiens
        ]);
    }
}
