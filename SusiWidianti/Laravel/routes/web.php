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
//KETIKA DOMAIN PERTAMA KITA AKSES OTOMATIS DI ROUTENYA YANG DIAKSESGET 
Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
});

// Routing atau url untuk jenis barang
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home', 'Backend\BerandaController@index')->name('Beranda');

        Route::get('/jenis_barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
        Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
        Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
        Route::get('delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
        Route::get('edit_jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
        Route::post('update_jenis_barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');

        Route::get('/user', 'Backend\UserController@index')->name('users');
        Route::get('/tambah_users', 'Backend\UserController@create')->name('tambah_users');
        Route::post('/store_users', 'Backend\UserController@store')->name('store_users');
        Route::get('delete_users/{id}', 'Backend\UserController@destroy')->name('delete_users');
        Route::get('edit_users/{id}', 'Backend\UserController@edit')->name('edit_users');
        Route::post('update_users/{id}', 'Backend\UserController@update')->name('update_users');

        Route::get('/barang', 'Backend\DataBarangController@index')->name('data_barang');
        Route::get('/tambah_barang', 'Backend\DataBarangController@create')->name('tambah_barang');
        Route::post('/store_barang', 'Backend\DataBarangController@store')->name('store_barang');
        Route::get('delete_barang/{id}', 'Backend\DataBarangController@destroy')->name('delete_barang');
        Route::get('edit_barang/{id}', 'Backend\DataBarangController@edit')->name('edit_barang');
        Route::get('show_barang/{id}', 'Backend\DataBarangController@show')->name('show_barang');
        Route::post('update_barang/{id}', 'Backend\DataBarangController@update')->name('update_barang');

        Route::resource('roles', RoleController::class);

        Route::get('/data_pengajuan', 'Backend\PengajuanBarangController@index')->name('pengajuan');
        Route::get('/data_pengajuan/barang', 'Backend\PengajuanBarangController@getBarangById')->name('pengajuan_barang');
        Route::get('/harga/stok/barang', 'Backend\PengajuanBarangController@getHargaStokBarangById');
        Route::get('/tambah_pengajuan', 'Backend\PengajuanBarangController@create')->name('tambah_data_pengajuan');
        Route::post('/store_data_pengajuan', 'Backend\PengajuanBarangController@store')->name('store_data_pengajuan');
        Route::get('delete_data_pengajuan/{id}', 'Backend\PengajuanBarangController@destroy')->name('delete_data_pengajuan');
        Route::get('edit_data_pengajuan/{id}', 'Backend\PengajuanBarangController@edit')->name('edit_data_pengajuan');
        Route::get('show_data_pengajuan/{id}', 'Backend\PengajuanBarangController@show')->name('show_data_pengajuan');
        Route::post('update_data_pengajuan/{id}', 'Backend\PengajuanBarangController@update')->name('update_data_pengajuan');

        Route::get('/terima_pengajuan/{id}', 'Backend\PengajuanBarangController@terimaPengajuan')->name('terima_pengajuan');
        Route::POST('/tolak_pengajuan/{id}', 'Backend\PengajuanBarangController@tolakPengajuan')->name('tolak_pengajuan');


        Route::get('/data_vendor', 'Backend\VendorController@index')->name('vendor');
        Route::get('/tambah_Vendor', 'Backend\VendorController@create')->name('tambah_Vendor');
        Route::post('/store_data_Vendor', 'Backend\VendorController@store')->name('store_data_Vendor');
        Route::get('delete_data_Vendor/{id}', 'Backend\VendorController@destroy')->name('delete_data_Vendor');
        Route::get('edit_data_Vendor/{id}', 'Backend\VendorController@edit')->name('edit_data_Vendor');
        Route::get('show_data_Vendor/{id}', 'Backend\VendorController@show')->name('show_data_Vendor');
        Route::post('update_data_Vendor/{id}', 'Backend\VendorController@update')->name('update_data_Vendor');


        



    });
});
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
