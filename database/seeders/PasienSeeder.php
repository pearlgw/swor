<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasiens = [
            [
                'nama' => 'Budi Santoso',
                'kode_pasien' => 'PSN001',
                'umur' => 45,
                'metode' => 'Fisioterapi',
                'diagnosa_utama' => 'Stroke Hemiparese Kanan',
                'tingkat_hemiparese' => 'Sedang',
                'riwayat_penyakit' => 'Hipertensi sejak 2018',
                'tanggal_sakit' => '2025-01-10',
                'tanggal_mulai_terapi' => '2025-01-20',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Siti Aminah',
                'kode_pasien' => 'PSN002',
                'umur' => 50,
                'metode' => 'Terapi Okupasi',
                'diagnosa_utama' => 'Stroke Hemiparese Kiri',
                'tingkat_hemiparese' => 'Ringan',
                'riwayat_penyakit' => 'Diabetes Mellitus',
                'tanggal_sakit' => '2025-02-01',
                'tanggal_mulai_terapi' => '2025-02-05',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Andi Wijaya',
                'kode_pasien' => 'PSN003',
                'umur' => 38,
                'metode' => 'Fisioterapi + Okupasi',
                'diagnosa_utama' => 'Cedera Otak Traumatik',
                'tingkat_hemiparese' => 'Berat',
                'riwayat_penyakit' => 'Kecelakaan lalu lintas 2024',
                'tanggal_sakit' => '2025-03-01',
                'tanggal_mulai_terapi' => '2025-03-10',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Dewi Lestari',
                'kode_pasien' => 'PSN004',
                'umur' => 42,
                'metode' => 'Fisioterapi',
                'diagnosa_utama' => 'Stroke Non-Hemoragik',
                'tingkat_hemiparese' => 'Sedang',
                'riwayat_penyakit' => 'Riwayat hipertensi keluarga',
                'tanggal_sakit' => '2025-01-25',
                'tanggal_mulai_terapi' => '2025-02-01',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Rahmat Hidayat',
                'kode_pasien' => 'PSN005',
                'umur' => 60,
                'metode' => 'Okupasi',
                'diagnosa_utama' => 'Stroke Hemiparese Kanan',
                'tingkat_hemiparese' => 'Ringan',
                'riwayat_penyakit' => 'Asam urat + hipertensi',
                'tanggal_sakit' => '2025-02-15',
                'tanggal_mulai_terapi' => '2025-02-22',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Farhan Syah',
                'kode_pasien' => 'PSN006',
                'umur' => 35,
                'metode' => 'Fisioterapi Intensif',
                'diagnosa_utama' => 'Cedera Tulang Belakang',
                'tingkat_hemiparese' => 'Berat',
                'riwayat_penyakit' => 'Patah tulang punggung',
                'tanggal_sakit' => '2025-01-05',
                'tanggal_mulai_terapi' => '2025-01-15',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Lina Marlina',
                'kode_pasien' => 'PSN007',
                'umur' => 55,
                'metode' => 'Terapi Okupasi',
                'diagnosa_utama' => 'Stroke Ringan',
                'tingkat_hemiparese' => 'Ringan',
                'riwayat_penyakit' => 'Kolesterol tinggi',
                'tanggal_sakit' => '2025-02-02',
                'tanggal_mulai_terapi' => '2025-02-08',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'kode_pasien' => 'PSN008',
                'umur' => 48,
                'metode' => 'Fisioterapi',
                'diagnosa_utama' => 'Stroke Hemoragik',
                'tingkat_hemiparese' => 'Sedang',
                'riwayat_penyakit' => 'Hipertensi kronis',
                'tanggal_sakit' => '2025-01-18',
                'tanggal_mulai_terapi' => '2025-01-28',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Kartika Putri',
                'kode_pasien' => 'PSN009',
                'umur' => 29,
                'metode' => 'Rehabilitasi Medik',
                'diagnosa_utama' => 'Cedera Otak Akibat Jatuh',
                'tingkat_hemiparese' => 'Sedang',
                'riwayat_penyakit' => 'Tidak ada',
                'tanggal_sakit' => '2025-03-05',
                'tanggal_mulai_terapi' => '2025-03-12',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Mulyadi',
                'kode_pasien' => 'PSN010',
                'umur' => 63,
                'metode' => 'Fisioterapi + Okupasi',
                'diagnosa_utama' => 'Stroke Iskemik',
                'tingkat_hemiparese' => 'Berat',
                'riwayat_penyakit' => 'Hipertensi + Diabetes',
                'tanggal_sakit' => '2025-01-30',
                'tanggal_mulai_terapi' => '2025-02-06',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Nur Aisyah',
                'kode_pasien' => 'PSN011',
                'umur' => 40,
                'metode' => 'Terapi Okupasi',
                'diagnosa_utama' => 'Stroke Non-Hemoragik',
                'tingkat_hemiparese' => 'Ringan',
                'riwayat_penyakit' => 'Asma sejak kecil',
                'tanggal_sakit' => '2025-02-20',
                'tanggal_mulai_terapi' => '2025-02-25',
                'dokter_id' => rand(2, 4),
            ],
            [
                'nama' => 'Joko Prasetyo',
                'kode_pasien' => 'PSN012',
                'umur' => 52,
                'metode' => 'Fisioterapi',
                'diagnosa_utama' => 'Stroke Hemiparese Kiri',
                'tingkat_hemiparese' => 'Sedang',
                'riwayat_penyakit' => 'Hipertensi ringan',
                'tanggal_sakit' => '2025-02-12',
                'tanggal_mulai_terapi' => '2025-02-18',
                'dokter_id' => rand(2, 4),
            ],
        ];

        foreach ($pasiens as $pasien) {
            Pasien::create($pasien);
        }
    }
}
