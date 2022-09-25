<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role:list',
            'role:create',
            'role:edit',
            'role:delete',
            'permission:list',
            'permission:create',
            'permission:edit',
            'permission:delete',

            'event:list',
            'event:dashboard',
            'event:check-in',
            'event:delete',
            'event:customize',
            'event:tickets',
            'event:orders',
            'event:create',
      
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
