<?php

use App\Http\Controllers\LoginController;
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

// Test Halaman Login
// Route::get('backend/login', [LoginController::class, 'loginBackend'])->name('backend.login');