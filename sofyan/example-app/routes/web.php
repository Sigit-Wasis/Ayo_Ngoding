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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    //BERANDA
    Route::get('/home', 'Backend\BerandaController@index')->name('beranda');


    //JENIS BARANG
    Route::get('/jenis-barang', 'Backend\JenisBarangController@index')->name('jenis-barang');
    Route::get('/tambah-jenis-barang', 'Backend\JenisBarangController@create')->name('tambah-jenis-barang');
    Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/edit_jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::put('/update_jenis_barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
    Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');

    //USERR
    Route::get('/user', 'Backend\UserController@index')->name('user');
    Route::get('/tambah-user', 'Backend\UserController@createUser')->name('tambah-user');
    Route::post('/userAdd', 'Backend\UserController@userAdd')->name('userAdd');
    Route::get('/edit_user/{id}', 'Backend\UserController@edit')->name('edit_user');
    Route::put('/update_user/{id}', 'Backend\UserController@update')->name('update_user');
    Route::get('/delete_user/{id}', 'Backend\UserController@deleteUser')->name('delete_user');

    //DATA BARANG
    Route::get('/data_barang','Backend\DataBarangController@index')->name('data_barang');
    Route::get('/tambah-barang', 'Backend\DataBarangController@createBarang')->name('tambah-barang');
    Route::post('/barangAdd', 'Backend\DataBarangController@barangAdd')->name('barangAdd');
    Route::get('/delete_barang/{id}', 'Backend\DataBarangController@deleteBarang')->name('delete_barang');
    Route::get('/edit_barang/{id}', 'Backend\DataBarangController@editBarang')->name('edit_barang');
    Route::put('/update_barang/{id}', 'Backend\DataBarangController@updateBarang')->name('update_barang');
    Route::get('/detail_barang/{id}', 'Backend\DataBarangController@detailBarang')->name('detail_barang');

});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
