<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListKeluargaController;
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

    });

    Route::prefix('data-keluarga')->group(function () {
        Route::get('/', [ListKeluargaController::class, 'index'])->name('dataKeluarga');
        Route::get('/tambah-keluarga', [ListKeluargaController::class, 'create'])->name('addKeluarga');
        Route::post('/create-keluarga', [ListKeluargaController::class, 'store'])->name('createKeluarga');
        Route::post('/fetch-rt', [ListKeluargaController::class, 'fetchRt'])->name('fetchRt');

        
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ListKeluargaController::class, 'index']);
        
    });

});
