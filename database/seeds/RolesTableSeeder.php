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

        Role::create([
            'name' => 'Administrador',
            'slug' => 'Administrador',
            'description' => 'No tiene acceso a reportes y/o usuarios',
        ]);
    }
}
