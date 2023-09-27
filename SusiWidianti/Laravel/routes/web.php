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
//KETIKA DOMAIN PERTAMA KITA AKSES OTOMATIS DI ROUTENYA YANG DIAKSESGET 
Route::get('/', function () {
     // return view('welcome');
      return view('auth.login');
});

// Routing atau url untuk jenis barang
    Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/home','Backend\BerandaController@index')->name('Beranda');

    Route::get('/jenis_barang','Backend\JenisBarangController@index')->name('jenis_barang');
    Route ::get ('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route ::post ('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('delete_jenis_barang/{id}','Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    Route::get('edit_jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('update_jenis_barang/{id }', 'Backend\JenisBarangController@update')->name('update_jenis_barang');

    Route::get('/user','Backend\UserController@index')->name('users');
    Route ::get ('/tambah_users', 'Backend\UserController@create')->name('tambah_users');
    Route ::post ('/store_users', 'Backend\UserController@store')->name('store_users');
    Route::get('delete_users/{id}','Backend\UserController@destroy')->name('delete_users');
    Route::get('edit_users/{id}', 'Backend\UserController@edit')->name('edit_users');
    Route::post('update_users/{id}', 'Backend\UserController@update')->name('update_users');


});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
