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
        Schema::table('hasil_monitorings', function (Blueprint $table) {
            $table->string('mode')->nullable()->after('kecepatan');
            $table->string('mode_tangan')->nullable()->after('mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_monitorings', function (Blueprint $table) {
            $table->dropColumn(['mode', 'mode_tangan']);
        });
    }
};
