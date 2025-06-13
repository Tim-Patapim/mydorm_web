<?php

use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\DormitizenController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route otentikasi
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::middleware(['auth'])->group(function () {

    // Route untuk paket
    Route::get('/paket', [PaketController::class, 'index'])->name('paket.index');
    Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::get('/paket/{id}/edit', [PaketController::class, 'edit'])->name('paket.edit');
    Route::put('/paket/{id}', [PaketController::class, 'update'])->name('paket.update');
    Route::delete('/paket/{paket}', [PaketController::class, 'destroy'])->name('paket.destroy');
    Route::get('/paket/search-dormitizen', [PaketController::class, 'searchDormitizen'])->name('paket.searchDormitizen');
    Route::get('/paket/{id}/gambar', [PaketController::class, 'detailGambar'])->name('paket.detailGambar');

    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/{id}', [KamarController::class, 'detail'])->name('kamar.detail');
    Route::get('/pelanggaran', [PelanggaranController::class, 'index'])->name('pelanggaran.index');

    // semua route berkaitan logs
    Route::get('/logs', [LogController::class, 'index'])->name('logskeluarmasuk.index');
    Route::get('/logs/tambah', [LogController::class, 'create'])->name('logskeluarmasuk.create');
    Route::post('/logs/store', [LogController::class, 'store'])->name('logskeluarmasuk.store');
    Route::delete('/logs/{id}', [LogController::class, 'destroy'])->name('logskeluarmasuk.destroy');
    Route::get('/logs/edit/{id}', [LogController::class, 'edit'])->name('logskeluarmasuk.edit');
    Route::put('/logs/update/{id}', [LogController::class, 'update'])->name('logskeluarmasuk.update');
    Route::get('logs/search-dormitizen', [LogController::class, 'searchDormitizen'])->name('logskeluarmasuk.searchDormitizen');

    // Routes for Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/berita/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/dormitizen', [DormitizenController::class, 'index'])->name('dormitizen.index');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/updateLog/{id}/{status}', [DashboardController::class, 'updateLog'])->name('dashboard.updateLog');
});
