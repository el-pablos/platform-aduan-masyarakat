<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Grup Warga - Dashboard Laporan
Route::middleware(['auth', 'verified', 'warga'])->prefix('dashboard')->group(function () {
    Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/create', [LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/', [LaporanController::class, 'store'])->name('laporan.store');
    Route::get('/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');
    Route::get('/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::put('/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
});

// Grup Admin/Petugas - Dashboard Admin
Route::middleware(['auth', 'petugas'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/laporan/{laporan}', [AdminController::class, 'showLaporan'])->name('laporan.show');
    Route::post('/laporan/{laporan}/tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store');
});

// Grup Admin Only - CRUD User & Kategori & Update Status
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::patch('/laporan/{laporan}/status', [AdminController::class, 'updateStatus'])->name('laporan.updateStatus');
});

// Profile Routes (untuk semua user yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
