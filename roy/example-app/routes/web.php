<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// KETIKA DOMAIN PERTAMA KITA AKSES OTOMATIS DIA ROUTENYA YANG DI AKSES GET/
Route::get('/', function () {
    // return view('welcome'); // ini diarahn ke halaman welcome
 return view('auth.login'); // ini diarahin ke halaman login
 });

// ROUTING ATAU URL UNTUK JENIS BARANG
Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/home', 'Backend\BerandaController@index')->name('beranda');

    Route::get('/jenis-barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
    Route::get('/tambah-jenis-barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::post('/store-jenis-barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('delete-jenis-barang/{id}', 'Backend\JenisBarangController@destory')->name('delete_jenis_barang');
    Route::get('edit-jenis-barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('/update-jenis-barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');

    Route::get('/user', 'Backend\userController@index')->name('user');
    Route::get('/tambah-user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store-user', 'Backend\userController@store')->name('store_user');
    Route::get('delete-user/{id}', 'Backend\userController@destroy')->name('delete_user');
    Route::get('edit-user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update-user/{id}', 'Backend\userController@update')->name('update_user');

    Route::get('/barang', 'Backend\DataBarangController@index')->name('barang');
    Route::get('/tambah-barang', 'Backend\DataBarangController@create')->name('tambah_barang');
    Route::post('/store-barang', 'Backend\DataBarangController@store')->name('store_barang');
    Route::get('delete-barang/{id}', 'Backend\DataBarangController@destroy')->name('delete_barang');
    Route::get('edit-barang/{id}', 'Backend\DataBarangController@edit')->name('edit_barang');
    Route::post('/update-barang/{id}', 'Backend\DataBarangController@update')->name('update_barang');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
