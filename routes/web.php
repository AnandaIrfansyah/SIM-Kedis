<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataAsnController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\PublicScanController;
use App\Http\Controllers\Admin\DataKendaraanController;
use App\Http\Controllers\Pegawai\PemeliharaanController;
use App\Http\Controllers\Admin\KepemilikanKendaraanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;

Route::get('/', function () {
    return view('pages.public.dashboard');
})->name('home');


Route::get('login', [LoginController::class, 'showLogin'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/scan/{qrCode}', [PublicScanController::class, 'show'])->name('scan.kendaraan');
Route::get('/foto/{qrCode}', [PublicScanController::class, 'foto'])->name('scan.foto');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin', DashboardController::class);
    Route::resource('asn', DataAsnController::class);
    Route::resource('kendaraan', DataKendaraanController::class);
    Route::resource('kepemilikan', KepemilikanKendaraanController::class);
    Route::patch('kepemilikan/{id}/selesai', [KepemilikanKendaraanController::class, 'selesai'])->name('kepemilikan.selesai');
});

// Pegawai routes
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::resource('pegawai', PegawaiDashboardController::class);
    Route::resource('pemeliharaan', PemeliharaanController::class);
});
