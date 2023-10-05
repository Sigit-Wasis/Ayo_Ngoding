<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## READ DATA USER
1.  Buat Route untuk user
    ```    
    Route::get('/user','Backend\userController@index')->name('user');
    Route::get('/tambah_user', 'Backend\userController@create')->name('tambah_user');
    Route::post('/store_user', 'Backend\userController@store')->name('store_user');
    Route::get('/edit_user/{id}', 'Backend\userController@edit')->name('edit_user');
    Route::post('/update_user/{id}', 'Backend\userController@update')->name('update_user');
    Route::get('/delete_user/{id}','Backend\userController@destroy')->name('delete_user');
    ```

    
2.  Buat controller di terminal dengan perintah
    ```
    php artisan make:controller Backend/UserController
    ``` 

3.  Update pada file UserContoller yang ada di folder app/Http/Controllers/Backend
    ```
    <?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use DB;

    class UserController extends Controller
    {
        public function index(){
            // query ini untuk mengambil data users secara keseluruhan dengan id secara descending(dari id terbesar ke terkecil)
            $users = DB::table('users')->select('users.*')->orderBy('users.id','DESC')
            ->paginate(10);

            return view('backend.user.index', compact('users'));
        }
    }
    ```

4.  Buat view untuk menampilkan data user di dalam folder Resources/view/backend/user/index.blade.php
    ```
    @extends('backend.app')

    @section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="col-md-2 mb-2">
                <!-- <a href="{{ route('tambah_jenis_barang')}}" class="btn btn-sm btn-block btn-success">Tambah User </a> -->
                </div>

                <div class="card">
                <div class="card-body">

                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5>    
                            <i class="icon fas fa-check"></i> Sukses!
                        </h5>
                        {{ Session('message') }}
                    </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $juser)    
                            <tr>
                                <!-- <th scope="row">{{ $loop->iteration }}</th> -->
                                <td>{{ $users->firstItem() + $loop->index}}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('enis_jbarang.edit', ['id' => $jenis->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="{{ route('delete_jenis_barang', $jenis->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </section>
    </div>

    @endsection
    ```

5. Buat menu user di dalam file sidebar.blade.php yang ada di dalam folder resources/view/backend/_partials/sidebar.blade.php
    ```
    <li class="nav-item">
        <a href="{{ route ('user') }}" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
                Data User
            </p>
        </a>
    </li>
    ```

## Role and Permissions
Laravel 9 User Roles and Permissions

1.  Buat controller di terminal dengan perintah
    ```
    composer require spatie/laravel-permission
    ``` 

2.  Buat controller di terminal dengan perintah
    ```
    php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
    ``` 

3.  Buat controller di terminal dengan perintah
    ```
    php artisan migrate
    ``` 

4.  menambahkan creat model di APP/Models/User.php
    ```
    use Spatie\Permission\Traits\HasRoles;

    class User extends Authenticatable
    {
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    }
    ```

5.  Add Middleware, di app/Http/Kernel.php
    ```'
    'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
    ```

6.  Create Routes di routes/web.php
    ```
    Route::resource('roles', RoleController::class);
    ```

7.  Buat controller di terminal dengan perintah
    ```
    php artisan make:controller Backend/RoleController
    ```

8.  web.php
    ```
    use App\Http\Controllers\Backend\RoleController;
    ```

9.  app/Http/Controllers/RoleController.php
    ```
        <?php

    namespace App\Http\Controllers\Backend;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Spatie\Permission\Models\Role;
    use Spatie\Permission\Models\Permission;
    use Illuminate\Support\Facades\DB;

    class RoleController extends Controller
    {
        //**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
    function __construct()
    {
            $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
            $this->middleware('permission:role-create', ['only' => ['create','store']]);
            $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
            $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
        * Display a listing of the resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }
    
    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }
    
    /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
    }

    ```

10. buat folder role di view/backend/roles
11. kemudian buat file index.blade.php di dalam folder roles
    ```
    ```

12. Create Seeder For Permissions and AdminUser
    database/seeders/PermissionTableSeeder.php

13. php artisan make:seeder PermissionTableSeeder

14. php artisan db:seed --class=PermissionTableSeeder

15. php artisan make:seeder CreateAdminUserSeeder

16. 