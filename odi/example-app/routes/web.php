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
Route::get('/',function(){
    // return view('welcome');
    return view('auth.login');

});
// Route::get('/', function () {
//     return view('backend.home.index');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::group(['middleware' => ['auth']], function (){
        Route::get('/home', 'Backend\BerandaController@index')->name('beranda');
        Route::get('/laporan', 'Backend\LaporanController@index')->name('laporan');

        Route::get('/jenis-barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
        Route::get('/tambah-jenis-barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
        Route::POST('/store-jenis-barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
        Route::get('/delete-jenis-barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
        Route::get('/edit-jenis-barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
        Route::post('/update-jenis-barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
        
        Route::get('/user', 'Backend\UsersController@index')->name('user');
        Route::get('/tambah-user', 'Backend\UsersController@create')->name('tambah_user');
        Route::POST('/store-user', 'Backend\UsersController@store')->name('store_user');
        Route::get('/delete-user/{id}', 'Backend\UsersController@destroy')->name('delete_user');
        Route::get('/edit-user/{id}', 'Backend\UsersController@edit')->name('edit_user');
        Route::post('/update-user/{id}', 'Backend\UsersController@update')->name('update_user');

        Route::get('/barang', 'Backend\BarangController@index')->name('barang');
        Route::get('/tambah-barang', 'Backend\BarangController@create')->name('tambah_barang');
        Route::POST('/store-barang', 'Backend\BarangController@store')->name('store_barang');
        Route::get('/delete-barang/{id}', 'Backend\BarangController@destroy')->name('delete_barang');
        Route::get('/edit-barang/{id}', 'Backend\BarangController@edit')->name('edit_barang');
        Route::get('/show-barang/{id}', 'Backend\BarangController@show')->name('show_barang');
        Route::post('/update-barang/{id}', 'Backend\BarangController@update')->name('update_barang');
        
        Route::get('/pengajuan', 'Backend\PengajuanController@index')->name('pengajuan');
        Route::get('/pengajuan/barang', 'Backend\PengajuanController@getBarangById')->name('pengajuan-barang'); 
        Route::get('/barang/harga/stok', 'Backend\PengajuanController@getHargaStokBarangById'); 
        Route::get('/tambah-pengajuan', 'Backend\PengajuanController@create')->name('tambah_pengajuan');
        Route::POST('/store-pengajuan', 'Backend\PengajuanController@store')->name('store_pengajuan');
        Route::get('/delete-pengajuan/{id}', 'Backend\PengajuanController@destroy')->name('delete_pengajuan');
        Route::get('/edit-pengajuan/{id}', 'Backend\PengajuanController@edit')->name('edit_pengajuan');
        Route::get('/show-pengajuan/{id}', 'Backend\PengajuanController@show')->name('show_pengajuan');
        Route::post('/update-pengajuan/{id}', 'Backend\PengajuanController@update')->name('update_pengajuan');

        Route::get('/delete-barang-pengajuan/{id_barang}/{id_pengajuan}', 'Backend\PengajuanController@destroyBarang')->name('delete_barang_pengajuan');

        Route::get('/terima-pengajuan/{id}', 'Backend\PengajuanController@terimapengajuan')->name('terima_pengajuan');
        Route::POST('/tolak-pengajuan/{id}', 'Backend\PengajuanController@tolakpengajuan')->name('tolak_pengajuan');
        Route::get('/terima-pengajuan-vendor/{id}', 'Backend\PengajuanController@terimapengajuanvendor')->name('terima_pengajuan_vendor');
        Route::POST('/tolak-pengajuan-vendor/{id}', 'Backend\PengajuanController@tolakpengajuanvendor')->name('tolak_pengajuan_vendor');

        Route::get('/vendor', 'Backend\VendorController@index')->name('vendor');       
        Route::get('/tambah-vendor', 'Backend\VendorController@create')->name('tambah_vendor');
        Route::POST('/store-vendor', 'Backend\VendorController@store')->name('store_vendor');
        Route::get('/delete-vendor/{id}', 'Backend\VendorController@destroy')->name('delete_vendor');
        Route::get('/edit-vendor/{id}', 'Backend\VendorController@edit')->name('edit_vendor');
        Route::get('/show-vendor/{id}', 'Backend\VendorController@show')->name('show_vendor');
        Route::post('/update-vendor/{id}', 'Backend\VendorController@update')->name('update_vendor');
        
        Route::resource('roles', RoleController::class);
        
    });   
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');