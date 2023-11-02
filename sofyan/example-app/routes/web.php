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

        //BERANDA
        Route::get('/home', 'Backend\BerandaController@index')->name('beranda');
        Route::get('/char', 'Backend\BerandaController@handleChart')->name('char');
        Route::get('/charvendordonut', 'Backend\BerandaController@vendorChartData')->name('charvendordonut');

        //JENIS BARANG
        Route::get('/jenis-barang', 'Backend\JenisBarangController@index')->name('jenis-barang');
        Route::get('/tambah-jenis-barang', 'Backend\JenisBarangController@create')->name('tambah-jenis-barang');
        Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
        Route::get('/edit_jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
        Route::put('/update_jenis_barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
        Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');

        //USER
        Route::get('/user', 'Backend\UserController@index')->name('user');
        Route::get('/tambah-user', 'Backend\UserController@createUser')->name('tambah-user');
        Route::post('/userAdd', 'Backend\UserController@userAdd')->name('userAdd');
        Route::get('/edit_user/{id}', 'Backend\UserController@edit')->name('edit_user');
        Route::put('/update_user/{id}', 'Backend\UserController@update')->name('update_user');
        Route::get('/delete_user/{id}', 'Backend\UserController@deleteUser')->name('delete_user');

        //DATA BARANG
        Route::get('/data_barang', 'Backend\DataBarangController@index')->name('data_barang');
        Route::get('/tambah-barang', 'Backend\DataBarangController@createBarang')->name('tambah-barang');
        Route::post('/barangAdd', 'Backend\DataBarangController@barangAdd')->name('barangAdd');
        Route::get('/delete_barang/{id}', 'Backend\DataBarangController@deleteBarang')->name('delete_barang');
        Route::get('/edit_barang/{id}', 'Backend\DataBarangController@editBarang')->name('edit_barang');
        Route::put('/update_barang/{id}', 'Backend\DataBarangController@updateBarang')->name('update_barang');
        Route::get('/detail_barang/{id}', 'Backend\DataBarangController@detailBarang')->name('detail_barang');

        Route::post('/barang/import', 'Backend\DataBarangController@importBarang')->name('spreadsheet');


        //Pengajuan
        Route::get('/pengajuan', 'Backend\TransaksiBarangController@index')->name('pengajuan');
        Route::get('/pengajuan/barang', 'Backend\TransaksiBarangController@getBarangById')->name('pengajuan-barang');
        Route::get('/barang/harga/stok', 'Backend\TransaksiBarangController@getHargaStokBarangById');
        Route::get('/tambah-pengajuan', 'Backend\TransaksiBarangController@create')->name('tambah_pengajuan');
        Route::post('/store-pengajuan', 'Backend\TransaksiBarangController@store')->name('store_pengajuan');
        Route::get('/detail_pengajuan/{id}', 'Backend\TransaksiBarangController@detailpengajuan')->name('detail_pengajuan');
        Route::get('/delete_pengajuan/{id}', 'Backend\TransaksiBarangController@deletepengajuan')->name('delete_pengajuan');
        Route::get('/delete_detail_pengajuan/{id_barang}/{id_pengajuan}', 'Backend\TransaksiBarangController@deletedetailpengajuan')->name('delete_detail_pengajuan');
        Route::get('/edit_pengajuan/{id}', 'Backend\TransaksiBarangController@editpengajuan')->name('edit_pengajuan');
        Route::post('/update_pengajuan/{id}', 'Backend\TransaksiBarangController@updatepengajuan')->name('update_pengajuan');

        Route::get('/terima_pengajuan/{id}', 'Backend\TransaksiBarangController@terimapengajuan')->name('terima_pengajuan');
        Route::post('/tolak_pengajuan/{id}', 'Backend\TransaksiBarangController@tolakpengajuan')->name('tolak_pengajuan');

        Route::get('/terima_vendor/{id}', 'Backend\TransaksiBarangController@terimavendor')->name('terima_vendor');
        Route::post('/tolak_vendor/{id}', 'Backend\TransaksiBarangController@tolakvendor')->name('tolak_vendor');

        //Vendor
        Route::get('/vendors', 'Backend\VendorController@index')->name('vendors');
        Route::get('/tambah_vendor', 'Backend\VendorController@createvendor')->name('tambah_vendor');
        Route::post('/store_vendor', 'Backend\VendorController@storevendor')->name('store_vendor');
        Route::get('/delete_vendor/{id}', 'Backend\VendorController@deletevendor')->name('delete_vendor');
        Route::get('/edit_vendor/{id}', 'Backend\VendorController@editvendor')->name('edit_vendor');
        Route::put('/update_vendor/{id}', 'Backend\VendorController@updatevendor')->name('update_vendor');

        //Laporan
        Route::get('/laporan', 'Backend\LaporanController@index')->name('laporan');
        Route::get('/cetak_laporan/{id}', 'Backend\LaporanController@cetak')->name('cetak_laporan');
        Route::get('/laporan2', 'Backend\LaporanController@cetak2')->name('laporan2');

        //roles
        Route::resource('roles', RoleController::class);
        Route::get('/tambah-permission', 'Backend\PermissionController@createpermission')->name('tambah-permission');
        Route::post('/permissionAdd', 'Backend\PermissionController@permissionAdd')->name('permissionAdd');
        Route::get('/delete_permission/{id}', 'Backend\PermissionController@deletepermission')->name('delete_permission');
        Route::get('/edit_permission/{id}', 'Backend\PermissionController@editpermission')->name('edit_permission');
        Route::put('/update_permission/{id}', 'Backend\PermissionController@updatepermission')->name('update_permission');
    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
