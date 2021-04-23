<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MasterUser = User::create([
            'name' => 'SFM Super Admin', 
            'email' => 'sfm.admin@shebatech.com.bd', 
            'password' => bcrypt('sfm#908'),
            'active'   => 1 
        ]);

        $SuperAdmin = User::create([
            'name' => 'Zulhas Emdad', 
            'email' => 'zulhas.emdad@shebatech.com.bd', 
            'password' => bcrypt('123456'),
            'active'   => 1 
        ]);

        $role = Role::where('name','Master')->pluck('id','id');
        $role2 = Role::where('name','Super-Admin')->pluck('id','id');

        $MasterUser->assignRole($role);
        $SuperAdmin->assignRole($role2);

    }
}
