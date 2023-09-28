<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    // return view('welcome'); // ini diarahin ke halaman welcome
     return view('auth.login'); // ini diarahin ke halaman login
});
 Route::group(['namespace' => 'App\Http\Controllers'], function(){
   Route::get('/home', 'Backend\BerandaController@index')->name('beranda');

    Route::get('/jenis-barang','Backend\JenisBarangController@index')->name('jenis_barang');
    Route::get('/tambah-jenis-barang','Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::post('/store-jenis-barang','Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/delete-jenis-barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    Route::get('/edit-jenis-barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('/update-jenis-barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
 
    Route::get('/user','Backend\userController@index')->name('user');
    Route::get('/tambah-user','Backend\userController@create')->name('tambah_user');
    Route::post('/store-user','Backend\userController@store')->name('store_user');
    Route::get('/delete-user/{id}', 'Backend\userController@destroy')->name('delete_user');
    Route::get('/edit-user/{id}', 'Backend\UserController@edit')->name('edit_user');
    Route::post('/update-user/{id}', 'Backend\userController@update')->name('update_user');

  });


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
