<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'dhitaaa',
            'nama_lengkap' => 'Dhita Humdana',
            'alamat' => 'Blitarejo',
            'no_telephone' => '088276257481',
            'email' => 'dhitahumdana@gmail.com',
            'password' => bcrypt('1234567890'), //password terbaru : 11223344

        ]);
        
        $role = Role::create(['name' => 'Admin']);
         
        $permissions = Permission::pluck('id','id')->all();
       
        $role->syncPermissions($permissions);
         
        $user->assignRole([$role->id]);
    }
}
