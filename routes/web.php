<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;

// Semua route di dalam grup ini butuh login dulu
Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');

    Route::get('/tambah-pengeluaran', function () {
        return view('tambah-pengeluaran');
    })->name('tambah-pengeluaran');
    Route::get('/tambah-pemasukan', function () {
        return view('tambah-pemasukan');
    })->name('tambah-pemasukan');
    Route::get('/kategori', function () {
        return view('kategori');
    })->name('kategori');
});
