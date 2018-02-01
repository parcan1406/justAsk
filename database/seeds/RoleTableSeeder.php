<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_regular = new Role();
        $role_regular->name = 'regular';
        $role_regular->description = 'Regular User role';
        $role_regular->save();
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'Admin User role';
        $role_admin->save();
    }
}
