<?php

namespace Database\Seeders;

use App\Models\HasilMonitoring;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HasilMonitoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2025, 8, 1);

        // Pasien yang akan diduplikasi (3 pasien sama)
        $duplicatePatients = [1, 2, 3];

        $data = [];

        for ($i = 0; $i < 12; $i++) {
            // Pilih pasien_id
            if ($i < count($duplicatePatients) * 4) {
                // Ulangi pasien 1,2,3 dengan interval mingguan
                $pasien_id = $duplicatePatients[$i % count($duplicatePatients)];
                $created_at = $startDate->copy()->addWeeks(intdiv($i, count($duplicatePatients)));
            } else {
                // Pasien lain bebas dari 4–12
                $pasien_id = rand(4, 12);
                $created_at = now();
            }

            $data[] = [
                'pasien_id'        => $pasien_id,
                'dokter_id'        => rand(2, 4),
                'tinggi_shoulder'  => rand(140, 180),
                'sudut_tangan'     => rand(20, 120),
                'kecepatan'        => rand(1, 10),
                'jenis_terapi'     => 'Terapi ' . rand(1, 3),
                'frekuensi_latihan' => rand(1, 7),
                'durasi_sesi'      => rand(30, 90),
                'jumlah_repetisi'  => rand(5, 20),
                'sudut_rotasi'     => rand(10, 90),
                'catatan'          => 'Catatan percobaan ' . ($i + 1),
                'jam_mulai'        => '08:00:00',
                'jam_selesai'      => '09:00:00',
                'status'           => collect(['selesai', 'berlangsung', 'batal'])->random(),
                'created_at'       => $created_at,
                'updated_at'       => $created_at,
            ];
        }

        HasilMonitoring::insert($data);
    }
}
