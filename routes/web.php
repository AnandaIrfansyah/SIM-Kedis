<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataAsnController;
use App\Http\Controllers\Admin\DataKendaraanController;
use App\Http\Controllers\Admin\KepemilikanKendaraanController;
use App\Http\Controllers\Auth\LoginCOntroller;
use App\Http\Controllers\Pegawai\DashboardController as PegawaiDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('login', [LoginCOntroller::class, 'showLogin'])->name('login');
Route::post('login', [LoginCOntroller::class, 'login'])->name('login.post');
Route::post('logout', [LoginCOntroller::class, 'logout'])->name('logout');

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
});
