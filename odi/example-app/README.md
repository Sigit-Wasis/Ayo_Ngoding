<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

1. buat route untuk user
    ```
    Route::get('/user', 'Backend\userController@index')-> name('user');
    Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
    Route::POST('/store_user', 'Backend\userController@store')->name('store_user');
    Route::get('/delete_user/{id}', 'Backend\userController@destroy')->name('delete_user');
    Route::get('/edit_user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update_user/{id}', 'Backend\userController@update')->name('update_user');
    ```
2. buat controller diterminal
    ```
    php artisan make:controller Backend/UsersController --resource 
    ```

3. update data contoller
    ```
        public function index()
        {
            $jenisBarang = DB::table('users')->select('users.*')->orderBy('users.id', 'DESC')
            ->paginate(10);

            // dd($jenisBarang);

            return view ('backend.user.index', compact('users'));
        }
    ```
4. 
5. membuat file user di sidebar.php