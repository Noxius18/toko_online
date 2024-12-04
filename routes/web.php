<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;


Route::get('/', function () {
    return redirect()->route('backend.login');
});

// Halaman Beranda
Route::get('backend/beranda',[BerandaController::class, 'berandaController'])
->name('backend.beranda')->middleware('auth');

// Halaman Login
Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');
Route::post('backend/login', [LoginController::class, 'authenticateBackend'])->name('backend.login');
Route::post('backend/logout', [LoginController::class, 'logoutBackend'])->name('backend.logout');

// End-Point untuk Route User
Route::resource('backend/user', UserController::class, ['as' => 'backend'])->middleware('auth');

// End-Point untuk Route cetak data User
Route::get('backend/laporan/formuser', [UserController::class, 'formUser'])->name('backend.laporan.formuser')->middleware('auth');
Route::post('backend/laporan/cetakuser', [UserController::class, 'cetakUser'])->name('backend.laporan.cetakuser')->middleware('auth');

// End-Point untuk Route Kategori
Route::resource('backend/kategori', KategoriController::class, ['as' => 'backend'])->middleware('auth');
// End-Point untuk Route Produk
Route::resource('backend/produk', ProdukController::class, ['as' => 'backend'])->middleware('auth');

// End-Point untuk Route cetak data Produk
Route::get('backend/laporan/formproduk', [ProdukController::class, 'formProduk'])->name('backend.laporan.formproduk')->middleware('auth');
Route::post('backend/laporan/cetakproduk', [ProdukController::class, 'cetakProduk'])->name('backend.laporan.cetakproduk')->middleware('auth');

// End-Point untuk Route Foto Produk
Route::post('foto_produk/store', [ProdukController::class, 'storeFoto'])->name('backend.foto_produk.store')->middleware('auth');
Route::delete('foto-produk/{id}', [ProdukController::class, 'destroyFoto'])->name('backend.foto_produk.destroy')->middleware('auth');

