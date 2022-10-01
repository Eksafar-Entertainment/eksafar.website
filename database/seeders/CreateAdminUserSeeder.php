<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $admin = Admin::create([
            'name' => 'Eksafar Webmaster', 
            'email' => 'webmaster@eksafar.club',
            'password' => bcrypt('12345678')
        ]);
    

        $role = Role::create(['name' => 'Admin', "guard_name"=>"admin"]);
     
        $permissions = Permission::pluck('id','id')->all();
   
        $role->syncPermissions($permissions);

        $admin->assignRole([$role->id]);
    }
}
