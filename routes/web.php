<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KepentinganController;
use App\Http\Controllers\ListKeluargaController;
use App\Http\Controllers\ListKetuaRtController;
use App\Http\Controllers\ListKetuaRwController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use App\Models\ListKetuaRt;
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


    // Kelurahan
    Route::prefix('kepentingan')->group(function () {
        Route::get('/', [KepentinganController::class, 'index'])->name('kepentingan');
        Route::get('/tambah', [KepentinganController::class, 'create'])->name('tambahKepentingan');
        Route::post('/add', [KepentinganController::class, 'store'])->name('addKepentingan');
        Route::get('/update/{id}', [KepentinganController::class, 'edit'])->name('editKepentingan');
        Route::post('/edit/{id}', [KepentinganController::class, 'update'])->name('updateKepentingan');
        Route::get('/delete/{id}', [KepentinganController::class, 'destroy'])->name('deleteKepentingan');
    });


    //Warga
    Route::prefix('surat-penghantar')->group(function () {
        Route::get('/', [SuratController::class, 'index'])->name('suratPenghantar');
        Route::get('/tambah', [SuratController::class, 'create'])->name('tambahSuratPenghantar');
        Route::post('/add', [SuratController::class, 'store'])->name('addSuratPenghantar');
        Route::get('/edit/{id}', [SuratController::class, 'edit'])->name('editSuratPenghantar');
        Route::post('/update/{id}', [SuratController::class, 'update'])->name('updateSuratPenghantar');
        Route::post('/fetch-profile', [SuratController::class, 'fetchProfile'])->name('fetchProfile');
        Route::post('/fetch-berkas', [SuratController::class, 'fetchBerkas'])->name('fetchBerkas');
        Route::get('/batalkan/{id}', [SuratController::class, 'destroy'])->name('batalkanSurat');
        Route::get('/detail/{id}', [SuratController::class, 'detailSurat'])->name('detailSurat');

        
        //Report Surat Penghantar atau Keterangan
        Route::get('/surat-rt-rw/{id}', [SuratController::class, 'showSuratRTRW'])->name('suratRtRw');
        Route::get('/surat-lurah/{id}', [SuratController::class, 'showSuratLurah'])->name('suratLurah');

        //Pengajuan RT, RW, Lurah
        Route::get('/pengajuan', [SuratController::class, 'showPengajuan'])->name('dataPengajuan');
        Route::post('/approve/{id}', [SuratController::class, 'approveSurat'])->name('aprrove');
        Route::post('/tolak/{id}', [SuratController::class, 'tolakSurat'])->name('tolak');
        
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

    Route::prefix('registrasi')->group(function () {
        Route::get('/rt-rw', [ListKetuaRtController::class, 'index'])->name('registrasiRTRW');
        Route::post('/fetch-rw-validate', [ListKetuaRtController::class, 'fetchRwValidate'])->name('fetchRwValidate');
        Route::post('/fetch-rt-validate', [ListKetuaRtController::class, 'fetchRtValidate'])->name('fetchRtValidate');
        Route::post('/add', [ListKetuaRtController::class, 'store'])->name('addRtRw');
        Route::get('/list-rw', [ListKetuaRwController::class, 'index'])->name('listRw');
        Route::get('/list-rt/{id}', [ListKetuaRtController::class, 'show'])->name('listRt');
        Route::post('/edit-rt-rw/{id}', [ListKetuaRtController::class, 'update'])->name('editRw');

        Route::get('/warga', [ListKetuaRtController::class, 'registrasiWarga'])->name('registrasiWarga');    
        Route::post('/add-warga', [ListKetuaRtController::class, 'create'])->name('addWarga');
        Route::get('/list-warga', [ListKetuaRtController::class, 'showListWarga'])->name('listWarga');    
        Route::get('/delete-warga/{id}', [ListKetuaRtController::class, 'destroy'])->name('deleteWarga');    
    });

    Route::get('/change-password', [ProfileController::class, 'show'])->name('changePassword');
    Route::post('/update-password', [ProfileController::class, 'store'])->name('updatePassword');

});
