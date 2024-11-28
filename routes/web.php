<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\pemilik\AmbulanceController;
use App\Http\Controllers\Pemilik\DashboardController;
use App\Http\Controllers\Pemilik\InstansiController;
use App\Http\Controllers\PublicController;
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

Route::get('/', [PublicController::class, 'index']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/proses-login', [AuthController::class, 'prosesLogin']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/proses-register', [AuthController::class, 'prosesRegister']);

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/pemilik'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::group(['prefix' => '/instansi'], function () {
            Route::get('/', [InstansiController::class, 'index']);
            Route::post('/simpan', [InstansiController::class, 'simpan']);
        });

        Route::group(['prefix' => '/ambulance'], function () {
            Route::get('/tambah', [AmbulanceController::class, 'tambah']);
            Route::post('/simpan', [AmbulanceController::class, 'simpan']);
        });
    });
});
