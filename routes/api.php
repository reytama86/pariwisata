<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\TestimoniController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function (){
    Route::post('admin',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
});

Route::group([
    'middleware' => 'api'
], function (){
    Route::resources([
        'cities' => CityController::class,
        'packages' => PackagesController::class,
        'sliders' => SliderController::class,
        'testimonis' => TestimoniController::class,
    ]);

    Route::get('pesanan/dikonfirmasi', [OrderController::class,'dikonfirmasi']);
    Route::get('pesanan/baru', [OrderController::class,'baru']);
    Route::get('pesanan/selesai', [OrderController::class,'selesai']);
    Route::post('pesanan/ubah_status/{order}', [OrderController::class,'ubah_status']);
    Route::get('reports', [ReportController::class,'get_reports']);
});

Route::post('/midtrans-callback',[HomeController::class, 'callback']);
