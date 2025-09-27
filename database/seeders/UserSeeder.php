<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokters = [
            [
                'name' => 'admin 1',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ],
            [
                'name' => 'Dokter 1',
                'email' => 'dokter1@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Dokter 2',
                'email' => 'dokter2@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Dokter 3',
                'email' => 'dokter3@gmail.com',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($dokters as $dokter) {
            User::create($dokter);
        }
    }
}
