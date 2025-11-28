<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UangMasukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\UangKeluarController;

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
    Route::post('/profile/security', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    // Detail riwayat by type and id
    Route::get('/riwayat/{type}/{id}', [RiwayatController::class, 'show'])
        ->where(['type' => 'masuk|keluar|data', 'id' => '[0-9]+'])
        ->name('riwayat.detail');

    Route::get('/tambah-pengeluaran', function () {
        return view('tambah_uang_keluar');
    })->name('tambah-pengeluaran');
    Route::post('/tambah-pengeluaran', [UangKeluarController::class, 'store'])->name('uang-keluar.store');
    Route::get('/tambah-pengeluaran/preview', [UangKeluarController::class, 'preview'])->name('uang-keluar.preview');
    Route::get('/tambah-pemasukan', [UangMasukController::class, 'create'])->name('tambah-pemasukan');
    Route::post('/tambah-pemasukan', [UangMasukController::class, 'store'])->name('tambah-pemasukan.store');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::put('/kategori/batch', [KategoriController::class, 'updateMultiple'])->name('kategori.updateMultiple');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->whereNumber('id')->name('kategori.update');

    Route::get('/sub-kategori/create', [SubKategoriController::class, 'create'])->name('subkategori.create');
    Route::post('/sub-kategori', [SubKategoriController::class, 'store'])->name('subkategori.store');
    Route::get('/sub-kategori/{id}/edit', [SubKategoriController::class, 'edit'])->whereNumber('id')->name('subkategori.edit');
    Route::put('/sub-kategori/{id}', [SubKategoriController::class, 'update'])->whereNumber('id')->name('subkategori.update');
    Route::delete('/sub-kategori/{id}', [SubKategoriController::class, 'destroy'])->whereNumber('id')->name('subkategori.destroy');
});
