<?php

/*
    Nama file   : web.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PenggunaController;
use App\Http\Middleware\NoStoreAfterLogout;
use Illuminate\Support\Facades\Route;


// ==========================================
// HALAMAN UNTUK TAMU (BELUM LOGIN)
// ==========================================

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'authenticate'])
        ->name('login.attempt');

});


// ==========================================
// HALAMAN INTERNAL (SUDAH LOGIN)
// ==========================================

Route::middleware([
    'auth',
    NoStoreAfterLogout::class
])->group(function () {

    // Halaman utama
    Route::get('/', fn () => redirect()->route('dashboard'));

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
		 ->name('mahasiswa.index');
   
    // Mata Kuliah
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])
        ->name('matakuliah.index');

    // KRS
    Route::get('/krs', [KrsController::class, 'index'])
        ->name('krs.index');

    // Beranda
    Route::get('/beranda', [BerandaController::class, 'index'])
        ->name('beranda');
	

// Langkah 5 dari jobsheet 11	
	// Dosen
    Route::get('/dosen/data', [DosenController::class, 'data'])
        ->name('dosen.data');
		
	 Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class)
            ->except(['index', 'show']);
	 });
			
	 Route::resource('dosen', DosenController::class)
        ->only(['index', 'show']);


    // Khusus Admin
    Route::get('/pengguna', [PenggunaController::class, 'index'])
        ->middleware('role:admin')
        ->name('pengguna.index');

    // Pengujian halaman 403
    Route::get('/test-403', function () {
        abort(403);
    });

});
