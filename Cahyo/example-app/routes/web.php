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
        // Route untuk Home
        Route::get('/home', 'Backend\BerandaController@index')->name('beranda');
        Route::get('/char', 'Backend\BerandaController@handleChart')->name('char');
        Route::get('/charvendordonut', 'Backend\BerandaController@vendorChartData')->name('charvendordonut');

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

        // Route data barang
        Route::get('/barang', 'Backend\dataBarangController@index')->name('barang');
        Route::get('/tambah_barang', 'Backend\dataBarangController@create')->name('tambah_barang');
        Route::post('/store_barang', 'Backend\dataBarangController@store')->name('store_barang');
        Route::get('/edit_barang/{id}', 'Backend\dataBarangController@edit')->name('edit_barang');
        Route::put('/update_barang/{id}', 'Backend\dataBarangController@update')->name('update_barang');
        Route::get('/delete_barang/{id}', 'Backend\dataBarangController@destroy')->name('delete_barang');
        Route::get('/show_barang/{id}', 'Backend\dataBarangController@show')->name('show_barang');

        Route::post('/barang/import','Backend\dataBarangController@import')->name('import.barang');

        // Route roles
        Route::resource('roles', RoleController::class);
        Route::get('/roles/delete/{id}', 'RoleController@destroy')->name('delete_role');

        // Route Permission
        Route::get('add-permission', 'Backend\PermissionController@create')->name('add.permission');
        Route::post('store-permission', 'Backend\PermissionController@store')->name('store.permission');
        Route::get('edit-permission/{id}', 'Backend\PermissionController@edit')->name('permission.edit');
        Route::post('update-permission/{id}', 'Backend\PermissionController@update')->name('permission.update');
        Route::get('destroy-permission/{id}', 'Backend\PermissionController@destroy')->name('permission.destroy');

        // Route Transaksi Pengajuan
        Route::get('/pengajuan', 'Backend\TransaksiPengajuanController@index')->name('pengajuan'); 
        Route::get('/pengajuan/barang', 'Backend\TransaksiPengajuanController@getBarangById')->name('pengajuan-barang'); 
        Route::get('/barang/harga/stok', 'Backend\TransaksiPengajuanController@getHargaStokBarangById'); 
        Route::get('/tambah-pengajuan', 'Backend\TransaksiPengajuanController@create')->name('tambah_pengajuan'); 
        Route::post('/store-pengajuan', 'Backend\TransaksiPengajuanController@store')->name('store_pengajuan');
        // Route::get('/transaksi_pengajuan', 'Backend\TransaksiPengajuanController@index')->name('transaksi_pengajuan');
        // Route::get('/pengajuan/barang', 'Backend\TransaksiPengajuanController@getBarangById')->name('pengajuan-barang');
        // Route::get('/barang/harga/stok', 'Backend\TransaksiPengajuanController@getHargaStokBarangById');
        // Route::get('/tambah_pengajuan', 'Backend\TransaksiPengajuanController@createPengajuan')->name('tambah_pengajuan');
        // Route::post('/store_pengajuan', 'Backend\TransaksiPengajuanController@storePengajuan')->name('store_pengajuan');
        Route::get('/edit_pengajuan/{id}', 'Backend\TransaksiPengajuanController@edit')->name('edit_pengajuan');
        Route::post('/update_pengajuan/{id}', 'Backend\TransaksiPengajuanController@update')->name('update_pengajuan');
        Route::get('/delete_pengajuan/{id}', 'Backend\TransaksiPengajuanController@destroy')->name('delete_pengajuan');
        Route::get('show_pengajuan/{id}', 'Backend\TransaksiPengajuanController@show')->name('show_pengajuan');

        Route::get('/terima_pengajuan/{id}', 'Backend\TransaksiPengajuanController@terimaPengajuan')->name('terima_pengajuan');
        Route::POST('/tolak_pengajuan/{id}', 'Backend\TransaksiPengajuanController@tolakPengajuan')->name('tolak_pengajuan');
        Route::get('/terima_vendor/{id}', 'Backend\TransaksiPengajuanController@terimavendor')->name('terima_vendor');
        Route::POST('/tolak_vendor/{id}', 'Backend\TransaksiPengajuanController@tolakvendor')->name('tolak_vendor');
        Route::get('/delete_barang_pengajuan/{id_barang}/{id_pengajuan}', 'Backend\TransaksiPengajuanController@destroyBarang')->name('delete_barang_pengajuan');
        
        // Route vendor
        Route::get('/vendor', 'Backend\VendorController@index')->name('vendor.index');
        Route::get('/vendor_create', 'Backend\VendorController@create')->name('vendor.create');
        Route::post('/vendor_store', 'Backend\VendorController@storevendor')->name('vendor.store');
        Route::get('/vendor_edit/{id}', 'Backend\vendorController@edit')->name('vendor.edit');
        Route::get('/vendor_destroy/{id}', 'Backend\vendorController@destroy')->name('vendor.destroy');
        Route::post('/vendor_update/{id}', 'Backend\vendorController@update')->name('vendor.update');

        // Route Laporan
        Route::get('/laporan', 'Backend\LaporanController@index')->name('laporan');
        Route::get('/cetak_laporan/{id}', 'Backend\LaporanController@cetak')->name('cetak_laporan'); 
        Route::get('/other-laporan', 'Backend\LaporanController@otherLaporan')->name('other_laporan');

    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
