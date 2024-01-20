<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PihakController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PersetujuanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['auth']], function(){
    Route::get('/', [DashboardController::class, 'index']);
    Route::prefix('kendaraan')->group(function(){
        Route::get('/', [KendaraanController::class, 'index']);
        Route::post('/detail', [KendaraanController::class, 'detail']);
        Route::post('/store', [KendaraanController::class, 'store']);
        Route::post('/update', [KendaraanController::class, 'update']);
        Route::post('/delete', [KendaraanController::class, 'destroy']);
    });
    Route::prefix('driver')->group(function(){
        Route::get('/', [DriverController::class, 'index']);
        Route::post('/store', [DriverController::class, 'store']);
        Route::post('/update',[DriverController::class, 'update']);
        Route::post('/delete', [DriverController::class, 'destroy']);
    });
    Route::prefix('pemesanan')->group(function(){
        Route::get('/', [PemesananController::class, 'index']);
        Route::post('/store', [PemesananController::class, 'store']);
        Route::post('/update',[PemesananController::class, 'update']);
        Route::post('/delete', [PemesananController::class, 'destroy']);
    });
    Route::prefix('pihak')->group(function(){
        Route::get('/', [PihakController::class, 'index']);
        Route::post('/store', [PihakController::class, 'store']);
        Route::post('/update', [PihakController::class, 'update']);
        Route::post('/delete', [PihakController::class, 'destroy']);
    });
    Route::get('/persetujuan',[PersetujuanController::class,'index']);
    Route::post('/setuju',[PersetujuanController::class,'persetujuan']);
    Route::post('/pemesanan-selesai',[PemesananController::class,'pemesananSelesai']);
    Route::post('/export-excel',[PemesananController::class,'exportExcel']);
});


Auth::routes(['register' => false,
                'reset' => false, 
                'verify' => false,
            ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
