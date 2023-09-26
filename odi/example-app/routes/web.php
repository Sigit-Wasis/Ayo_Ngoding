<?php

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

// Route::get('/', function () {
//     return view('backend.home.index');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/', 'Backend\BerandaController@index')-> name('beranda');

    Route::get('/jenis_barang', 'Backend\JenisBarangController@index')-> name('jenis_barang');

    Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::POST('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    Route::get('/edit_jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('/update_jenis_barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
    
});