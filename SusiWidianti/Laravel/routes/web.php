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

// // Route::get('/', function () {
// //     return view('backend.home.index');
// });

// Routing atau url untuk jenis barang
Route::group(['namespace' => 'App\Http\Controllers'], function() {
    
    Route::get('/','Backend\BerandaController@index')->name('Beranda');

    Route::get('/jenis_barang','Backend\JenisBarangController@index')->name('jenis_barang');
    Route ::get ('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route ::post ('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('delete_jenis_barang/{id}','Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
});