<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestimoniController;

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

//auth
Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('login',[AuthController::class,'login']);

Route::get('login_member',[AuthController::class,'login_member'])->name('login_member');
Route::post('login_member',[AuthController::class,'login_member_action']);

Route::get('register_member',[AuthController::class,'register_member'])->name('register_member');
Route::post('register_member',[AuthController::class,'register_member_action']);

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('logout',[AuthController::class,'logout']);

//kategori admin
Route::get('/city',[CityController::class,'list']);
Route::get('/package_admin',[PackagesController::class, 'list']);
Route::get('/slider',[SliderController::class, 'list']);
Route::get('/testimoni',[TestimoniController::class, 'list']);

//home

Route::get('/',[HomeController::class,'index']);
Route::get('/search',[HomeController::class,'search_button']);
Route::get('/package/{id}',[HomeController::class,'package']);
Route::get('/packages/{city}',[HomeController::class,'packages']);
Route::get('/cart',[HomeController::class,'cart']);
Route::get('/checkout',[HomeController::class,'checkout']);
Route::get('/orders',[HomeController::class,'orders']);

Route::post('/add_to_cart',[HomeController::class,'add_to_cart']);
Route::post('/packages/search', [HomeController::class, 'searchPackages'])->name('package.search');
Route::get('/search-results', [HomeController::class, 'showResults'])->name('package.results');
Route::post('/add_to_cart',[HomeController::class,'add_to_cart']);
Route::get('/delete_from_cart/{cart}',[HomeController::class,'delete_from_cart']);
Route::post('/checkout_orders',[HomeController::class,'checkout_orders']);

Route::get('/pesanan/baru',[OrderController::class, 'list']);
Route::get('/pesanan/dikonfirmasi',[OrderController::class, 'dikonfirmasi_list']);
Route::get('/pesanan/dikemas',[OrderController::class, 'dikemas_list']);
Route::get('/pesanan/dikirim',[OrderController::class, 'dikirim_list']);
Route::get('/pesanan/diterima',[OrderController::class, 'diterima_list']);
Route::get('/pesanan/selesai',[OrderController::class, 'selesai_list']);
Route::get('/pesanan/selesai',[OrderController::class, 'selesai_list']);

