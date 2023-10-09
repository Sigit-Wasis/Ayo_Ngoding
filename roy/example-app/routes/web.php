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
Route::group(['middleware' => ['auth']], function () {

    Route::resource('roles', RoleController::class);

    Route::group(['namespace' => 'App\Http\Controllers',], function () {
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
        Route::get('show-barang/{id}', 'Backend\DataBarangController@show')->name('show_barang');
        Route::get('edit-barang/{id}', 'Backend\DataBarangController@edit')->name('edit_barang');
        Route::post('/update-barang/{id}', 'Backend\DataBarangController@update')->name('update_barang');

        Route::get('/pengajuan', 'Backend\PengajuanController@index')->name('pengajuan');
        Route::get('/tambah-pengajuan', 'Backend\PengajuanController@create')->name('tambah_pengajuan');
        Route::post('/store-pengajuan', 'Backend\PengajuanController@store')->name('store_pengajuan');
        Route::get('delete-pengajuan/{id}', 'Backend\PengajuanController@destroy')->name('delete_pengajuan');
        Route::get('show-pengajuan/{id}', 'Backend\PengajuanController@show')->name('show_pengajuan');
        Route::get('edit-pengajuan/{id}', 'Backend\PengajuanController@edit')->name('edit_pengajuan');
        Route::post('/update-pengajuan/{id}', 'Backend\PengajuanController@update')->name('update_pengajuan');

        Route::get('/vendor', 'Backend\vendorController@index')->name('vendor');
        Route::get('/tambah-vendor', 'Backend\vendorController@create')->name('tambah_vendor');
        Route::post('/store-vendor', 'Backend\vendorController@store')->name('store_vendor');
        Route::get('delete-vendor/{id}', 'Backend\vendorController@destory')->name('delete_vendor');
        Route::get('edit-vendor/{id}', 'Backend\vendorController@edit')->name('edit_vendor');
        Route::post('/update-vendor/{id}', 'Backend\vendorController@update')->name('update_vendor');


        Route::resource('roles', RoleController::class);
    });
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
