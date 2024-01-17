<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KendaraanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
