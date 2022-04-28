<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/shops/download', 'App\Http\Controllers\ShopController@exportIntoExcel')->name('shops.download');

Route::get('/shops/import', 'App\Http\Controllers\ShopController@import')->name('shops.import');

Route::post('/shops/import', 'App\Http\Controllers\ShopController@uploadFile')->name('shops.upload');

Route::resource('shops', 'App\Http\Controllers\ShopController' , ['only'=> ['index','create','store' , 'update']]);



