<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role  = Role::create(['name' => 'Master']);
        $role2 = Role::create(['name' => 'Super-Admin']);
        
        $Permissions = Permission::pluck('id','id')->all();
        
        $role->syncPermissions($Permissions);
        $role2->syncPermissions($Permissions);
    }
}
