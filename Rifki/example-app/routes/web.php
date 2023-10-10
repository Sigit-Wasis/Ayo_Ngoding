<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

// ROUTING ATAU URL UNTUK JENIS BARANG
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/home', 'Backend\BerandaController@index')->name('beranda');
        Route::get('/jenis-barang', 'Backend\JenisBarangController@index')->name('jenis_barang');
        Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
        Route::post('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
        Route::get('jenis-barang/edit/{id}', 'Backend\JenisBarangController@edit')->name('jenis_barang.edit');
        Route::put('jenis-barang/update/{id}', 'Backend\JenisBarangController@update')->name('jenis_barang.update');
        Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');


        Route::get('/user', 'Backend\UserController@index')->name('user');
        Route::get('/tambah-user', 'Backend\UserController@create')->name('tambah_user');
        Route::post('/store-user', 'Backend\UserController@store')->name('store_user');
        Route::get('/delete-user/{id}', 'Backend\UserController@destroy')->name('delete_user');
        Route::get('/edit-user/{id}', 'Backend\UserController@edit')->name('edit_user');
        Route::post('update-user/{id}', 'Backend\UserController@update')->name('update_user');

        Route::get('/barang', 'Backend\BarangController@index')->name('barang.index');
        // Route::get('/show_barang', 'JenisBarangController@show')->name('Show_barang');
        Route::get('/show_barang/{id}', 'Backend\BarangController@show')->name('Show_barang');
        Route::get('/tambah_barang', 'Backend\BarangController@create')->name('tambah_barang');
        Route::post('/store_data_barang', 'Backend\BarangController@store')->name('store_barang');
        Route::get('barang/edit/{id}', 'Backend\BarangController@edit')->name('barang.edit');
        Route::put('/barang/update/{id}', 'Backend\BarangController@update')->name('barang.update');
        Route::get('delete_barang/{id}', 'Backend\BarangController@delete')->name('delete_barang');

        Route::resource('roles', RoleController::class);

        Route::get('/pengajuan', 'Backend\PengajuanController@index')->name('pengajuan.index');
        Route::get('/barang/add', 'Backend\PengajuanController@index')->name('barangAdd');

        Route::get('pengajuan_barang/create', 'Backend\PengajuanController@create')->name('pengajuan_barang.create');
        // Route::get('/show_barang/{id}', 'Backend\BarangController@show')->name('Show_barang');
        Route::post('/store_pengajuan', 'Backend\PengajuanController@store')->name('store_pengajuan');
        // Route::get('barang/edit/{id}', 'Backend\BarangController@edit')->name('barang.edit');
        // Route::put('/barang/update/{id}', 'Backend\BarangController@update')->name('barang.update');
        // Route::get('delete_barang/{id}', 'Backend\BarangController@delete')->name('delete_barang');

        Route::get('/vendor', 'Backend\VendorController@index')->name('vendor.index');
        Route::get('/vendor_create', 'Backend\VendorController@create')->name('vendor.create');
        Route::get('/vendor_store', 'Backend\VendorController@store')->name('vendor.store');
        Route::get('/vendor_edit/{id}', 'Backend\VendorController@edit')->name('vendor.edit');
        Route::put('/vendor_update/{id}', 'Backend\VendorController@update')->name('vendor.update');
        Route::delete('/vendor-destroy/{id}', 'Backend\VendorController@destroy')->name('vendor.destroy');



    });
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
