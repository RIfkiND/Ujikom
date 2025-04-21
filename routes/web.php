<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DasboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Function\PelangganController;
use App\Http\Controllers\Function\TarifController;
use App\Http\Controllers\Function\PemakaianController;
use App\Http\Controllers\Function\PembayaranController;


Route::get("/",[HomeController::class,"index"])->name("home");

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DasboardController::class, 'index'])->name('dashboard');
    Route::get('/tarif', [DasboardController::class, 'tarif'])->name('dashboard.tarif');
    Route::get('/pelanggan', [DasboardController::class, 'pelanggan'])->name('dashboard.pelanggan');
    Route::get('/pemakaian', [DasboardController::class, 'pemakaian'])->name('dashboard.pemakaian');
    Route::get('/history', [DasboardController::class, 'history'])->name('dashboard.history');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});



Route::prefix('dashboard/pelanggan')->middleware(['auth'])->name('pelanggan.')->middleware(['auth'])->group(function () {
    Route::get('create', [PelangganController::class, 'create'])->name('create');
    Route::get('pelanggan/{no_kontrol}', [PelangganController::class, 'show'])->name('show');
    Route::post('/', [PelangganController::class, 'store'])->name('store');
    Route::get('{no_kontrol}/edit', [PelangganController::class, 'edit'])->name('edit');
    Route::put('{no_kontrol}', [PelangganController::class, 'update'])->name('update');
    Route::delete('{no_kontrol}', [PelangganController::class, 'destroy'])->name('destroy');
});


Route::prefix('dashboard/tarifs')->middleware(['auth'])->name('tarif.')->group(function () {
    Route::get('create', [TarifController::class, 'create'])->name('create');
    Route::post('/', [TarifController::class, 'store'])->name('store');
    Route::get('{id}/edit', [TarifController::class, 'edit'])->name('edit');
    Route::put('{id}', [TarifController::class, 'update'])->name('update');
    Route::delete('{id}', [TarifController::class, 'destroy'])->name('destroy');
});
Route::prefix('dashboard/pemakaian')->middleware(['auth'])->name('pemakaian.')->group(function () {
    Route::get('/create', [PemakaianController::class, 'create'])->name('create');
    Route::post('/', [PemakaianController::class, 'store'])->name('store');
    Route::get('/{id}', [PemakaianController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PemakaianController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PemakaianController::class, 'update'])->name('update');
    Route::delete('/{id}', [PemakaianController::class, 'destroy'])->name('destroy');
});


Route::prefix('pembayaran')->group(function () {
    Route::get('/pemakaian/{pemakaian_id}/create', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pemakaian/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

Route::get('/laporan/pembayaran', [PembayaranController::class, 'generateLaporan'])->name('laporan.pembayaran');
Route::get('/pemakaian/{id}/pdf', [PembayaranController::class, 'generatePdf'])->name('laporan.struct');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
