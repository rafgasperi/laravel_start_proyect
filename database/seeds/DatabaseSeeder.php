<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::transaction(function (){
            $this->call(CreateGroupSedder::class);
            $this->call(CreateAdminUser::class);
            $this->call(CreateUserSeeder::class);
        });
    }
}
