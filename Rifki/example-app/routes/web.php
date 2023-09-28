<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

// ROUTING ATAU URL UNTUK JENIS BARANG
    Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::get('/home', 'Backend\BerandaController@index')->name('beranda');
    Route::get('/jenis-barang','Backend\JenisBarangController@index')->name('jenis_barang');
    Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('jenis-barang/edit/{id}', 'Backend\JenisBarangController@edit')->name('jenis_barang.edit');
    Route::put('jenis-barang/update/{id}', 'Backend\JenisBarangController@update')->name('jenis_barang.update');
    Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');

    
    Route::get('/user', 'Backend\UserController@index')->name('user');
    Route::get('/tambah-user','Backend\UserController@create')->name('tambah_user');
    Route::post('/store-user', 'Backend\UserController@store')->name('store_user');
    Route::get('/delete-user/{id}', 'Backend\UserController@destroy')->name('delete_user');
    Route::get('/edit-user/{id}', 'Backend\UserController@edit')->name('edit_user');
    Route::post('update-user/{id}', 'Backend\UserController@update')->name('update_user');


       
        
    
    
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
