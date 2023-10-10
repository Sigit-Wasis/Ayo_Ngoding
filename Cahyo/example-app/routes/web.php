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

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home', 'Backend\BerandaController@index')->name('beranda');

        Route::get('/jenis_barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
        Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
        Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
        Route::get('/jenis_barang/edit/{id}', 'Backend\JenisBarangController@edit')->name('jenis_barang.edit');
        Route::put('/jenis_barang/update/{id}', 'Backend\JenisBarangController@update')->name('jenis_barang.update');
        Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');

        // Route untuk user
        Route::get('/user', 'Backend\userController@index')->name('user');
        Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
        Route::post('/store_user', 'Backend\userController@store')->name('store_user');
        Route::get('/edit_user/{id}', 'Backend\userController@edit')->name('edit_user');
        Route::post('/update_user/{id}', 'Backend\userController@update')->name('update_user');
        Route::get('/delete_user/{id}', 'Backend\userController@destroy')->name('delete_user');
        Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
        Route::post('/store_user', 'Backend\userController@store')->name('store_user');

        Route::get('/barang', 'Backend\dataBarangController@index')->name('barang');
        Route::get('/tambah_barang', 'Backend\dataBarangController@create')->name('tambah_barang');
        Route::post('/store_barang', 'Backend\dataBarangController@store')->name('store_barang');
        Route::get('/edit_barang/{id}', 'Backend\dataBarangController@edit')->name('edit_barang');
        Route::put('/update_barang/{id}', 'Backend\dataBarangController@update')->name('update_barang');
        Route::get('/delete_barang/{id}', 'Backend\dataBarangController@destroy')->name('delete_barang');
        Route::get('/show_barang/{id}', 'Backend\dataBarangController@show')->name('show_barang');

        Route::resource('roles', RoleController::class);
        Route::get('/roles/delete/{id}', 'RoleController@destroy')->name('delete_role');

        Route::get('/transaksi_pengajuan', 'Backend\TransaksiPengajuanController@index')->name('transaksi_pengajuan');
        Route::get('/transaksi-pengajuan', [TransaksiPengajuanController::class, 'index'])->name('transaksi-pengajuan.index');
        Route::resource('/transaksi-pengajuan', TransaksiPengajuanController::class);
        
        Route::get('/vendor', 'Backend\VendorController@index')->name('vendor.index');
        Route::get('/vendor_create', 'Backend\VendorController@create')->name('vendor.create');
        Route::post('/vendor_store', 'Backend\VendorController@store')->name('vendor.store');

    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
