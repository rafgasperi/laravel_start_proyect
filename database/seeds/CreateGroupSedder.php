<?php

use Illuminate\Database\Seeder;

class CreateGroupSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = [
            'name' => 'Administratores',
            'slug' => 'administratores',
            'permissions' => [
                "user.index"=>true,
                "user.create"=>true,
                "user.store"=>true,
                "user.show"=>true,
                "user.edit"=>true,
                "user.perfil"=>true,
                "user.update"=>true,
                "user.destroy"=>true,
                "user.change_password"=>true,
                "user.subir_foto"=>true,
                "user.permisos"=>true,
                "role.index"=>true,
                "role.create"=>true,
                "role.show"=>true,
                "role.edit"=>true,
                "role.update"=>true,

                "ejemplo.index"=>true,
                "ejemplo.create"=>true,
                "ejemplo.show"=>true,
                "ejemplo.edit"=>true,
                "ejemplo.update"=>true,
                "ejemplo.destroy"=>true,
            ]
        ];

        Sentinel::getRoleRepository()->createModel()->fill($adminRole)->save();

        $userRole = [
            'name' => 'Usuarios',
            'slug' => 'usuarios',
            'permissions' => [
                "user.index"=>true,
                "user.store"=>true,
                "user.show"=>true,
                "user.perfil"=>true,
                "user.update"=>true,
                "user.change_password"=>true,
                "user.subir_foto"=>true,

                "ejemplo.index"=>true,
                "ejemplo.create"=>true,
                "ejemplo.show"=>true,
                "ejemplo.edit"=>true,
                "ejemplo.update"=>true,
                "ejemplo.destroy"=>true,
            ]
        ];

        Sentinel::getRoleRepository()->createModel()->fill($userRole)->save();

    }
}
