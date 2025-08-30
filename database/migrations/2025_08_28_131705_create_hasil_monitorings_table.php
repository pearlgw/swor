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
        Schema::create('hasil_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->cascadeOnDelete();
            $table->foreignId('dokter_id')->nullable()->constrained('users')->nullOnDelete();

            $table->float('tinggi_shoulder')->nullable(); // cm
            $table->float('sudut_tangan')->nullable();    // derajat
            $table->float('kecepatan')->nullable(); //

            $table->string('jenis_terapi')->nullable();
            $table->integer('frekuensi_latihan')->nullable(); // kali per minggu
            $table->integer('durasi_sesi')->nullable();       // menit
            $table->integer('jumlah_repetisi')->nullable(); // kali per sesi

            $table->float('sudut_rotasi')->nullable(); // dari rotary encoder

            $table->text('catatan')->nullable();

            $table->time('jam_mulai')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_monitorings');
    }
};
