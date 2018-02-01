<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_regular = Role::where('name', 'regular')->first();
        $role_admin  = Role::where('name', 'admin')->first();
        $regular = new User();
        $regular->name = 'Andrey';
        $regular->email = 'a.kiselev1406@gmail.com';
        $regular->password = bcrypt('123456');
        $regular->save();
        $regular->roles()->attach($role_regular);
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->save();
        $admin->roles()->attach($role_admin);
    }
}
