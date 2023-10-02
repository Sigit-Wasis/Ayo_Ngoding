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

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/home', 'Backend\BerandaController@index')->name('beranda');
    
    Route::get('/jenis_barang','Backend\JenisBarangController@index')->name('jenis_barang');
    Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/jenis_barang/edit/{id}', 'Backend\JenisBarangController@edit')->name('jenis_barang.edit');
    Route::put('/jenis_barang/update/{id}', 'Backend\JenisBarangController@update')->name('jenis_barang.update');
    Route::get('/delete_jenis_barang/{id}','Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    
    // Route untuk user
    Route::get('/user','Backend\userController@index')->name('user');
    Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store_user', 'Backend\userController@store')->name('store_user');
    Route::get('/edit_user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update_user/{id}', 'Backend\userController@update')->name('update_user');
    Route::get('/delete_user/{id}','Backend\userController@destroy')->name('delete_user');
    Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store_user', 'Backend\userController@store')->name('store_user');

    
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
