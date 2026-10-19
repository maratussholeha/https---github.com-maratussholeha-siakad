
<?php
/*
    Nama file   : web.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MataKuliahController;

// Halaman utama diarahkan ke dashboard
Route::get('/', fn() => redirect()->route('dashboard'));

// Halaman dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Halaman beranda
Route::get('/beranda', [BerandaController::class, 'index'])
    ->name('beranda');

// Halaman mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
    ->name('mahasiswa.index');

// Halaman dosen
Route::get('/dosen', [DosenController::class, 'index'])
    ->name('dosen.index');

// Halaman KRS
Route::get('/krs', [KrsController::class, 'index'])
    ->name('krs.index');

// Halaman Mata Kuliah
Route::get('/matakuliah', [MataKuliahController::class, 'index'])
    ->name('matakuliah.index');
