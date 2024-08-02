<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Middleware\EnsureSecondLogin;

// Route::get('/', function () {
//     return view('welcome');
// });

// // login
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// // login kedua
// Route::get('/login-second', [AuthController::class, 'showSecondLoginForm'])->name('login-second');
// Route::post('/login-second', [AuthController::class, 'secondLogin'])->name('login-second.submit');

// Route::middleware([EnsureSecondLogin::class])->group(function () {
    // Route::post('/search', [AuthController::class, 'search'])->name('search');
//     // dashboard
//     Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
//     // profile
//     Route::get('/profile', [AuthController::class,'profile'])->name('profile');
//     // list pegawai
//     Route::get('/pegawai', [AuthController::class,'pegawai'])->name('pegawai');
//     Route::post('/cari-pegawai', [AuthController::class, 'searchPegawai'])->name('cari-pegawai');
//     Route::get('/api/profil-pegawai/{nip}', [AuthController::class, 'getProfile']);
//     Route::get('/coba',[AuthController::class, 'coba'])->name('coba');
//     Route::get('/api/profile/{nip}', [AuthController::class, 'getProfileByNip'])->name('profile.by.nip');
//     //ubah password
//     Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('show-change-password-form');
//     Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change-password');
//     // logout
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });
