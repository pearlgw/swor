<?php

use App\Http\Controllers\Api\V1\HasilMonitoringController;
use App\Http\Controllers\Api\V1\PasienController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('api.token')->group(function () {
    Route::get('/pasien', [PasienController::class, 'getAllPasien']);
    Route::post('/monitoring', [HasilMonitoringController::class, 'store']);
});
