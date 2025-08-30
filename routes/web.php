<?php

use App\Http\Controllers\HasilMonitoringController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/monitoring-download', function () {
    return view('monitoring');
})->name('monitoring.page');

Route::get('/monitoring/data', [HomepageController::class, 'getMonitoringData'])->name('monitoring.data');
Route::post('/monitoring/download', [HomepageController::class, 'download'])->name('monitoring.download');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dokter', [UserController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/create', [UserController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [UserController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{id}/edit', [UserController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{id}', [UserController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{id}', [UserController::class, 'destroy'])->name('dokter.destroy');

    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasiens/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::get('/pasiens/{id}', [PasienController::class, 'show'])->name('pasien.show');
    Route::put('/pasiens/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    Route::get('/monitoring', [HasilMonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/create', [HasilMonitoringController::class, 'create'])->name('monitoring.create');
    Route::post('/monitoring', [HasilMonitoringController::class, 'store'])->name('monitoring.store');
    Route::get('/monitoring/{id}/edit', [HasilMonitoringController::class, 'edit'])->name('monitoring.edit');
    Route::get('/monitoring/{id}', [HasilMonitoringController::class, 'show'])->name('monitoring.show');
    Route::put('/monitoring/{id}', [HasilMonitoringController::class, 'update'])->name('monitoring.update');
    Route::delete('/monitoring/{id}', [HasilMonitoringController::class, 'destroy'])->name('monitoring.destroy');
});

require __DIR__ . '/auth.php';
