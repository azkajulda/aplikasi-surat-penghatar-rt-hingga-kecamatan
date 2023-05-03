<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListKeluargaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('beranda');

    Route::prefix('surat-penghantar')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('suratPenghantar');
        Route::get('/tambah', [SuratController::class, 'create'])->name('tambahSuratPenghantar');
        Route::post('/add', [SuratController::class, 'store'])->name('addSuratPenghantar');
        Route::get('/edit/{id}', [SuratController::class, 'edit'])->name('editSuratPenghantar');
        Route::post('/update/{id}', [SuratController::class, 'update'])->name('updateSuratPenghantar');
        Route::post('/fetch-profile', [SuratController::class, 'fetchProfile'])->name('fetchProfile');
        Route::get('/batalkan/{id}', [SuratController::class, 'destroy'])->name('batalkanSurat');
        
        Route::get('/surat-rt-rw/{id}', [SuratController::class, 'show'])->name('suratRtRw');
    });

    Route::prefix('data-keluarga')->group(function () {
        Route::get('/', [ListKeluargaController::class, 'index'])->name('dataKeluarga');
        Route::get('/tambah-keluarga', [ListKeluargaController::class, 'create'])->name('addKeluarga');
        Route::post('/create-keluarga', [ListKeluargaController::class, 'store'])->name('createKeluarga');
        Route::post('/fetch-rt', [ListKeluargaController::class, 'fetchRt'])->name('fetchRt');
        Route::get('/delete-keluarga/{id}', [ListKeluargaController::class, 'destroy'])->name('deleteKeluarga');
        
    });

    Route::prefix('profile')->group(function () {
        Route::get('/{id}', [ProfileController::class, 'index'])->name('profile');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('editProfile');
        Route::post('/update/{id}', [ProfileController::class, 'update'])->name('updateProfile');
    });

    Route::get('/change-password', [ProfileController::class, 'show'])->name('changePassword');
    Route::post('/update-password', [ProfileController::class, 'store'])->name('updatePassword');

});
