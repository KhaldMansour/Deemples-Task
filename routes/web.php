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

Route::get('/', 'App\Http\Controllers\ShopController@index');

Route::group(['namespace' => 'App\Http\Controllers'] , function ($router) {

    Route::group(['prefix' => 'shops' , 'as'=>'shops.'] , function ($router) {

        Route::get('/download', 'ShopController@exportIntoExcel')->name('download');
        
        Route::get('/import', 'ShopController@import')->name('import');
        
        Route::post('/import', 'ShopController@uploadFile')->name('upload');

        Route::get('/', 'ShopController@index')->name('index');

        Route::post('/', 'ShopController@store')->name('store');

        Route::post('/update', 'ShopController@update')->name('update');

        Route::delete('/{id}', 'ShopController@delete')->name('destroy');
    });

});





