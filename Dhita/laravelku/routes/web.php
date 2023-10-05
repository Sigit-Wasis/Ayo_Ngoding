<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Backend\RoleController;

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

// keika domain pertama kita akses otomatis di routenya yang di akses get /
Route::get('/', function () {
    return view('auth.login');
});

// ROUTING ATAU URL UNTUK JENIS BARANG
Route::group(['namespace' =>'App\Http\Controllers'], function() {
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/home', 'Backend\BerandaController@index')->name('beranda');

        Route::get('/jenis_barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
        Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
        Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
        Route::get('/delete_jenis_barang/{id}','Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
        Route::get('/edit_jenis_barang/{id}','Backend\JenisBarangController@edit')->name('edit_jenis_barang');
        Route::post('/update_jenis_barang/{id}','Backend\JenisBarangController@update')->name('update_jenis_barang');
    
        Route::get('/user', 'Backend\UserController@index')->name('user');
        Route::get('/tambah_user', 'Backend\UserController@create')->name('tambah_user');
        Route::post('/store_user', 'Backend\UserController@store')->name('store_user');
        Route::get('/delete_user/{id}','Backend\UserController@destroy')->name('delete_user');
        Route::get('/edit_user/{id}','Backend\UserController@edit')->name('edit_user');
        Route::post('/update_user/{id}','Backend\UserController@update')->name('update_user');

        Route::get('/data_barang', 'Backend\DataBarangController@index')->name('data_barang');
        Route::get('/tambah_barang', 'Backend\DataBarangController@create')->name('tambah_barang');
        Route::post('/store_barang', 'Backend\DataBarangController@store')->name('store_barang');
        Route::get('/delete_barang/{id}','Backend\DataBarangController@destroy')->name('delete_barang');
        Route::get('/edit_barang/{id}','Backend\DataBarangController@edit')->name('edit_barang');
        Route::post('/edit_barang/{id}', 'Backend\DataBarangController@update')->name('update_barang');
        Route::get('/show_barang/{id}', 'Backend\DataBarangController@show')->name('show_barang');

        Route::resource('roles', RoleController::class);

    });
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
