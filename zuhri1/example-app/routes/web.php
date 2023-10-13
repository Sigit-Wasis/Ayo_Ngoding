<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\Backend\RoleController;
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
Route::group(['namespace' => 'App\Http\Controllers'], function () {
  Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'Backend\BerandaController@index')->name('beranda');

    Route::get('/jenis-barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
    Route::get('/tambah-jenis-barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::post('/store-jenis-barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/delete-jenis-barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    Route::get('/edit-jenis-barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('/update-jenis-barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');

    Route::get('/user', 'Backend\userController@index')->name('user');
    Route::get('/tambah-user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store-user', 'Backend\userController@store')->name('store_user');
    Route::get('/delete-user/{id}', 'Backend\userController@destroy')->name('delete_user');
    Route::get('/edit-user/{id}', 'Backend\UserController@edit')->name('edit_user');
    Route::post('/update-user/{id}', 'Backend\userController@update')->name('update_user');

    //Data Barang

    Route::get('/DataBarang', 'Backend\DataBarangController@index')->name('DataBarang');
    Route::get('/tambah-DataBarang', 'Backend\DataBarangController@create')->name('tambah_DataBarang');
    Route::post('/store-DataBarang', 'Backend\DataBarangController@store')->name('store_DataBarang');
    Route::get('/delete-DataBarang/{id}', 'Backend\DataBarangController@destroy')->name('delete_DataBarang');
    Route::get('/edit-DataBarang/{id}', 'Backend\DataBarangController@edit')->name('edit_DataBarang');
    Route::post('/update-DataBarang/{id}', 'Backend\DataBarangController@update')->name('update_DataBarang');
    Route::get('/show-DataBarang/{id}', 'Backend\DataBarangController@show')->name('show_DataBarang');


    //PENGAJUAN BARANG
    // Route::get('/pengajuan-barang', 'Backend\Pengajuan_barangController@index')->name('pengajuan_barang');
    // Route::get('/pengajuan/barang', 'Backend\Pengajuan_barangController@getBarangById')->name('pengajuan-barang');
    // Route::get('/barang/harga/stok', 'Backend\Pengajuan_barangController@getHargaBarangStokById');
    // Route::get('/tambah-pengajuan-barang', 'Backend\Pengajuan_barangController@create')->name('tambah_pengajuan_barang');
    // Route::post('/store-pengajuan-barang', 'Backend\Pengajuan_barangController@store')->name('store_pengajuan_barang');
    // Route::get('/delete-pengajuan-barang/{id}', 'Backend\Pengajuan_barangController@destroy')->name('delete_pengajuan_barang');
    // Route::get('/edit-pengajuan-barang/{id}', 'Backend\Pengajuan_barangController@edit')->name('edit_pengajuan_barang');
    // Route::post('/update-pengajuan-barang/{id}', 'Backend\Pengajuan_barangController@update')->name('update_pengajuan_barang');
    // Route::get('/show-pengajuan-barang/{id}', 'Backend\Pengajuan_barangController@show')->name('show_pengajuan_barang');

    Route::get('/pengajuan', 'Backend\Pengajuan_barangController@index')->name('pengajuan'); 
    Route::get('/pengajuan/barang', 'Backend\Pengajuan_barangController@getBarangById')->name('pengajuan-barang'); 
    Route::get('/barang/harga/stok', 'Backend\Pengajuan_barangController@getHargaStokBarangById'); 
    Route::get('/tambah-pengajuan', 'Backend\Pengajuan_barangController@create')->name('tambah_pengajuan_barang'); 
    Route::post('/store-pengajuan', 'Backend\Pengajuan_barangController@store')->name('store_pengajuan');
    Route::get('/edit-pengajuan/{id}', 'Backend\Pengajuan_barangController@edit')->name('pengajuan_edit');
    Route::get('/delete-pengajuan/{id}', 'Backend\Pengajuan_barangController@destroy')->name('pengajuan_delete');
    Route::get('/show-pengajuan/{id}', 'Backend\Pengajuan_barangController@show')->name('show_pengajuan');
   
    Route::get('/terima-pengajuan/{id}', 'Backend\Pengajuan_barangController@terimaPengajuan')->name('terima_pengajuan');
    Route::post('/tolak-pengajuan/{id}', 'Backend\Pengajuan_barangController@tolakpengajuan')->name('tolak_pengajuan');
    
    //vendor
    Route::get('/vendor', 'Backend\vendorController@index')->name('vendor');
    Route::get('/tambah-vendor', 'Backend\vendorController@create')->name('tambah_vendor');
    Route::post('/store-vendor', 'Backend\vendorController@store')->name('store_vendor');
    Route::get('/delete-vendor/{id}', 'Backend\vendorController@destroy')->name('delete_vendor');
    Route::get('/edit-vendor/{id}', 'Backend\vendorController@edit')->name('edit_vendor');
    Route::post('/update-vendor/{id}', 'Backend\vendorController@update')->name('update_vendor');
    Route::get('/show-vendor/{id}', 'Backend\vendorController@show')->name('show_vendor');


    Route::resource('roles', RoleController::class);
  });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
