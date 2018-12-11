<?php

use Illuminate\Database\Seeder;

class CreateAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Register a new user
        $user = Sentinel::registerAndActivate([
            'email'      => 'admin@admin.com',
            'first_name' =>'Administrador',
            'last_name'  =>'del Sistema',
            'password'   => 'test',
        ]);

        $role = Sentinel::findRoleByName('Administratores');

        $role->users()->attach($user);
    }
}
