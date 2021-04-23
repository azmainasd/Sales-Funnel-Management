<?php

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
            'Sales-Funnel-Create',
            'Sales-Funnel-Edit',
            'Sales-Funnel-Delete',
            'Reports-List',
            'Master-Data-Create',
            'Master-Data-Edit',
            'Master-Data-Delete',
            'User-Create',
            'User-Edit',
            'User-Delete',
            'Role-Create',
            'Role-Edit',
            'Role-Delete'
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
