<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\DropabsentController;
use App\Http\Controllers\DropnilaiController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JamController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPassController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TryoutController;
use App\Http\Controllers\UserJadwalController;
use App\Http\Controllers\UserprofilController;
use App\Http\Controllers\UserSiswaController;
use App\Http\Controllers\UtbkController;
use Illuminate\Support\Facades\Route;
Route::get('/', function(){
    return view('auth.login');
});
Route::middleware(['auth', 'verified', 'is_user'])->group(function(){
    Route::get('/home', [UserSiswaController::class, 'index'])->name('home');

    Route::get('/absent', [AbsenController::class, 'index']);
    Route::get('/absent/create/{kelas:id}', [AbsenController::class, 'showmap']);
    Route::post('/absent', [AbsenController::class, 'store']);
    
    Route::get('/score/create/utbk', [ScoreController::class, 'utbkIndex']);
    Route::patch('/score/create/utbk', [ScoreController::class, 'notecreate']);

    Route::get('/score', [ScoreController::class, 'index']);
    Route::get('/score/create/{kelas}', [ScoreController::class, 'showmapel']);
    Route::get('/score/create', [ScoreController::class, 'create']);
    Route::get('/score/insert/{siswa:slug}', [ScoreController::class, 'insert']);
    Route::post('/score', [ScoreController::class, 'store']);

    Route::get('/schedule', [UserJadwalController::class, 'index']);
    
    Route::patch('/user/{user:slug}', [UserprofilController::class, 'update']);

    Route::get('/absent/create', [AbsenController::class, 'create']);

    Route::get('/user/{user:slug}/edit', [UserprofilController::class, 'edit']);
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'is_admin'])->name('dashboard');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [PengajarController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{user:slug}/edit', [PengajarController::class, 'edit']);
    Route::get('/dashboard/create', [PengajarController::class, 'create']);
    Route::post('/dashboard', [PengajarController::class, 'store']);
    Route::get('/dashboard/{user:name}', [PengajarController::class, 'destroy']);
    Route::patch('/dashboard/{user:slug}', [PengajarController::class, 'update']);

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/create', [KelasController::class, 'create']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy']);
    Route::get('/kelas/{kelas:kelas}/edit', [KelasController::class, 'edit']);
    Route::patch('/kelas/{kelas:kelas}', [KelasController::class, 'update']);
    Route::get('/kelas/{kelas:kelas}', [KelasController::class, 'show']);

    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
    Route::get('/mapel/create', [MapelController::class, 'create']);
    Route::post('/mapel', [MapelController::class, 'store']);
    Route::delete('/mapel/{mapel:slug}', [MapelController::class, 'destroy']);
    Route::get('/mapel/{mapel:slug}/edit', [MapelController::class, 'edit']);
    Route::patch('/mapel/{mapel:slug}', [MapelController::class, 'update']);

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswa/create', [SiswaController::class, 'create']);
    Route::post('/siswa', [SiswaController::class, 'store']);
    Route::get('/siswa/{siswa:nis}/edit', [SiswaController::class, 'edit']);
    Route::patch('/siswa/{siswa:nis}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{siswa:nis}', [SiswaController::class, 'destroy']);
    Route::get('/siswa/{siswa:nis}', [SiswaController::class, 'show']);

    Route::get('/category', [categoryController::class, 'index'])->name('category');
    Route::get('/category/create', [categoryController::class, 'create']);
    Route::post('/category', [categoryController::class, 'store']);
    Route::delete('/category/{category:slug}', [categoryController::class, 'destroy']);

    Route::get('/utbk', [UtbkController::class, 'index'])->name('utbk');
    Route::delete('/utbk/drop', [UtbkController::class, 'Drop']);
    Route::get('/utbk/create', [UtbkController::class, 'create']);
    Route::post('/utbk', [UtbkController::class, 'store']);
    Route::delete('/utbk/{utbk:utbk}', [UtbkController::class, 'destroy']);
    Route::get('/utbk/createScore', [UtbkController::class, 'createScore']);
    Route::post('/utbk/score', [UtbkController::class, 'storescore']);
    Route::get('/utbk/{utbk:utbk}/edit', [UtbkController::class, 'edit']);
    Route::patch('/utbk/{utbk:utbk}', [UtbkController::class, 'update']);
    Route::patch('/utbkscore/{siswa:slug}', [UtbkController::class, 'editscore']);
    Route::post('/utbkscore/create/{siswa:slug}', [UtbkController::class, 'utbk']);

    Route::get('/absensi', [DropabsentController::class, 'index'])->name('absensi');
    Route::delete('/absensi/delete', [DropabsentController::class, 'Drop']);
    Route::get('/absensi/{absensi:id}/edit', [DropabsentController::class, 'edit']);
    Route::patch('/absensi/{absensi:id}', [DropabsentController::class, 'update']);

    Route::get('/nilai', [DropnilaiController::class, 'index'])->name('nilai');
    Route::delete('/nilai/delete', [DropnilaiController::class, 'Drop']);
    Route::get('/nilai/{nilai:id}/edit', [DropnilaiController::class, 'edit']);
    Route::patch('/nilai/{nilai:id}', [DropnilaiController::class, 'update']);
    Route::delete('/nilai/{nilai:id}', [DropnilaiController::class, 'destroy']);

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::get('/jadwal/jam/create', [JamController::class, 'create']);
    Route::post('/jadwal/jam/add', [JamController::class, 'store']);
    Route::get('/jadwal/{jam}/edit', [JamController::class, 'edit']);
    Route::patch('/jadwal/{jam}', [JamController::class, 'update']);
    Route::delete('/jadwal/{jam}', [JamController::class, 'destroy']);
    Route::get('/jadwal/create', [JadwalController::class, 'create']);
    Route::post('/jadwal', [JadwalController::class, 'store']);
    Route::delete('/jadwal/{schedule}/hapus', [JadwalController::class, 'destroy']);
    Route::get('/edit/{schedule}', [JadwalController::class, 'edit']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/download/all', [SiswaController::class, 'all']);
    Route::get('/download/{siswa:nis}', [SiswaController::class, 'download']);

    Route::patch('/reset/{user:slug}', [ResetPassController::class, 'update']);
});

require __DIR__.'/auth.php';
