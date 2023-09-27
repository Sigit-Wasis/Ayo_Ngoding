<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/login',function(){
    // return view('welcome');
    return view('auth.login');

});
// Route::get('/', function () {
//     return view('backend.home.index');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::get('/home', 'Backend\BerandaController@index')-> name('beranda');

    Route::get('/jenis_barang', 'Backend\JenisBarangController@index')-> name('jenis_barang');
    Route::get('/tambah_jenis_barang', 'Backend\JenisBarangController@create')->name('tambah_jenis_barang');
    Route::POST('/store_jenis_barang', 'Backend\JenisBarangController@store')->name('store_jenis_barang');
    Route::get('/delete_jenis_barang/{id}', 'Backend\JenisBarangController@destroy')->name('delete_jenis_barang');
    Route::get('/edit_jenis_barang/{id}', 'Backend\JenisBarangController@edit')->name('edit_jenis_barang');
    Route::post('/update_jenis_barang/{id}', 'Backend\JenisBarangController@update')->name('update_jenis_barang');
    
    Route::get('/user', 'Backend\UsersController@index')-> name('user');
    Route::get('/tambah_user', 'Backend\UsersController@create')->name('tambah_user');
    Route::POST('/store_user', 'Backend\UsersController@store')->name('store_user');
    Route::get('/delete_user/{id}', 'Backend\UsersController@destroy')->name('delete_user');
    Route::get('/edit_user/{id}', 'Backend\UsersController@edit')->name('edit_user');
    Route::post('/update_user/{id}', 'Backend\UsersController@update')->name('update_user');
   
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
