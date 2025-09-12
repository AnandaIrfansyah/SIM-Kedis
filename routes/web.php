<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DataAsnController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Public\PublicScanController;
use App\Http\Controllers\Admin\DataKendaraanController;
use App\Http\Controllers\Pegawai\PemeliharaanController;
use App\Http\Controllers\Admin\KepemilikanKendaraanController;
use App\Http\Controllers\Admin\PemeliharaanKendaraanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;

Route::get('/', function () {
    return view('pages.public.dashboard');
})->name('home');


Route::get('login', [LoginController::class, 'showLogin'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.post');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// SCAN QR Code
Route::get('/api/scan/{qrCode}', [PublicScanController::class, 'scanApi'])->name('scan.api');
Route::get('/scan/{qrCode}', [PublicScanController::class, 'scanView'])->name('scan.view');

// Update Password (semua user login bisa akses)
Route::middleware('auth')->group(function () {
    Route::get('/update-password', [LoginController::class, 'showUpdatePassword'])->name('password.form');
    Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('password.update');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin', DashboardController::class);
    Route::get('asn/inactive', [DataAsnController::class, 'inactive'])->name('asn.inactive');
    Route::resource('asn', DataAsnController::class);
    Route::patch('/asn/{id}/status', [DataAsnController::class, 'updateStatus'])->name('asn.update-status');

    Route::get('kendaraan/inactive', [DataKendaraanController::class, 'inactive'])->name('kendaraan.inactive');
    Route::resource('kendaraan', DataKendaraanController::class)->except(['show']);
    Route::resource('kendaraan', DataKendaraanController::class);
    Route::patch('/kendaraan/{id}/status', [DataKendaraanController::class, 'updateStatus'])
        ->name('kendaraan.update-status');
    Route::get('/cetak-qrcode', [DataKendaraanController::class, 'cetakQrCode'])->name('kendaraan.cetak.qrcode');

    Route::resource('kepemilikan', KepemilikanKendaraanController::class);
    Route::get('kepemilikan/nonaktif', [KepemilikanKendaraanController::class, 'inactive'])
        ->name('kepemilikan.inactive');
    Route::patch('kepemilikan/{id}/selesai', [KepemilikanKendaraanController::class, 'selesai'])->name('kepemilikan.selesai');
    Route::resource('pemeliharaanKendaraan', PemeliharaanKendaraanController::class);
    Route::get('pemeliharaanKendaraan/create/{kendaraan}', [PemeliharaanKendaraanController::class, 'create'])
        ->name('pemeliharaanKendaraan.create');
    Route::get('pemeliharaanKendaraan/{kendaraan}', [PemeliharaanKendaraanController::class, 'show'])
        ->name('pemeliharaanKendaraan.show');
});

// Pegawai routes
Route::middleware(['auth', 'role:pegawai'])->group(function () {
    Route::resource('pegawai', PegawaiDashboardController::class);
    Route::resource('pemeliharaan', PemeliharaanController::class);
});
