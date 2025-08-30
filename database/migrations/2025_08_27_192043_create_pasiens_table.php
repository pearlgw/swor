<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode_pasien')->unique();
            $table->integer('umur')->nullable();
            $table->string('metode')->nullable();
            $table->text('diagnosa_utama')->nullable();
            $table->string('tingkat_hemiparese')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->date('tanggal_sakit')->nullable();
            $table->date('tanggal_mulai_terapi')->nullable();
            $table->foreignId('dokter_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete(); // kalau dokter dihapus, set null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasiens');
    }
};
