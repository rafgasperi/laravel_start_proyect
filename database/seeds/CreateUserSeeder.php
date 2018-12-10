<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Sentinel;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,15) as $index) {

            $gender = $faker->randomElement(['male','female']);

            $u = Sentinel::registerAndActivate([
                     'email' => $faker->email,
                  'username' => $faker->userName,
                   'password'=> 'test',
                'first_name' => $faker->firstName($gender),
                 'last_name' => $faker->lastName
            ]);

            $u->save();
            $role = Sentinel::findRoleByName('Usuarios');
            $role->usuarios()->attach($u);

        }
    }
}
