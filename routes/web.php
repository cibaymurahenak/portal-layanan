<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Rute yang tidak memerlukan autentikasi
Route::get('/', function () {
    return redirect()->route('login-second');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Login kedua
Route::get('/login-second', [AuthController::class, 'showSecondLoginForm'])->name('login-second');
Route::post('/login-second', [AuthController::class, 'secondLogin'])->name('login-second.submit');
Route::get('/reload-captcha', function () {
    return response()->json(['captcha'=> captcha_img()]);
});

// Rute yang memerlukan autentikasi
Route::post('/search', [AuthController::class, 'search'])->name('search');
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [AuthController::class,'profile'])->name('profile');
//
Route::get('/pegawai', [AuthController::class,'pegawai'])->name('pegawai');
Route::post('/cari-pegawai', [AuthController::class, 'searchPegawai'])->name('cari-pegawai');
Route::get('/api/profil-pegawai/{nip}', [AuthController::class, 'getProfile']);
//
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('show-change-password-form');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
//
Route::get('edit-profile',[AuthController::class, 'editProfile'])->name('edit-profile');
//
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/coba',[AuthController::class, 'coba'])->name('coba');
