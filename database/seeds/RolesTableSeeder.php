<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Super Administrador',
            'slug' => 'superAdministrador',
            'description' => 'Tiene acceso total a las operaciones del sistema',
            'special' => 'all-access'
        ]);


        $administrador = Role::create([
            'name' => 'Administrador',
            'slug' => 'administrador',
            'description' => 'No tiene acceso a reportes y/o usuarios',
        ]);

        $administrador->givePermissionTo([
            'categorias.index',
            'categorias.create',
            'categorias.show',
            'categorias.edit',
            'categorias.show',
            'categorias.destroy',
        ]);

        $distribuidor = Role::create([
            'name' => 'Distribuidor',
            'slug' => 'distribuidor',
            'description' => 'Tiene acceso a su perfil y a la store',
        ]);

        $cliente = Role::create([
            'name' => 'Cliente',
            'slug' => 'cliente',
            'description' => 'Tiene acceso a su perfil y a la store',
        ]);
    }
}
