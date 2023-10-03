<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/home', 'Backend\BerandaController@index')-> name('beranda');

    Route::get('/jenis-barang', 'Backend\JenisBarangController@index')-> name('jenis_barang');
    Route::get('/tambah-jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::POST('/store-jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/delete-jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    Route::get('/edit-jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('/update-jenis_barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
    
    Route::get('/user', 'Backend\UsersController@index')-> name('user');
    Route::get('/tambah-user', 'Backend\UsersController@create')->name('tambah_user');
    Route::POST('/store-user', 'Backend\UsersController@store')->name('store_user');
    Route::get('/delete-user/{id}', 'Backend\UsersController@destroy')->name('delete_user');
    Route::get('/edit-user/{id}', 'Backend\UsersController@edit')->name('edit_user');
    Route::post('/update-user/{id}', 'Backend\UsersController@update')->name('update_user');

    Route::get('/barang', 'Backend\BarangController@index')-> name('barang');
    Route::get('/tambah-barang', 'Backend\BarangController@create')->name('tambah_barang');
    Route::POST('/store-barang', 'Backend\BarangController@store')->name('store_barang');
    Route::get('/delete-barang/{id}', 'Backend\BarangController@destroy')->name('delete_barang');
    Route::get('/edit-barang/{id}', 'Backend\BarangController@edit')->name('edit_barang');
    Route::get('/show-barang/{id}', 'Backend\BarangController@show')->name('show_barang');
    Route::post('/update-barang/{id}', 'Backend\BarangController@update')->name('update_barang');
   
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');