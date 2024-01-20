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
    Route::get('/kendaraan', [KendaraanController::class, 'index']);
    Route::post('/store-kendaraan', [KendaraanController::class, 'store']);
    Route::post('/update-kendaraan', [KendaraanController::class, 'update']);
    Route::post('/delete-kendaraan', [KendaraanController::class, 'destroy']);
    Route::get('/driver', [DriverController::class, 'index']);
    Route::post('/store-driver', [DriverController::class, 'store']);
    Route::post('/update-driver',[DriverController::class, 'update']);
    Route::post('/delete-driver', [DriverController::class, 'destroy']);
    Route::get('/pemesanan', [PemesananController::class, 'index']);
    Route::post('/store-pemesanan', [PemesananController::class, 'store']);
    Route::post('/update-pemesanan',[PemesananController::class, 'update']);
    Route::post('/delete-pemesanan', [PemesananController::class, 'destroy']);
    Route::get('/pihak', [PihakController::class, 'index']);
    Route::post('/store-pihak', [PihakController::class, 'store']);
    Route::post('/update-pihak', [PihakController::class, 'update']);
    Route::post('/delete-pihak', [PihakController::class, 'destroy']);
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
