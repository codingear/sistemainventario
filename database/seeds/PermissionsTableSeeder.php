<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administradores
        Permission::create([
            'name'           => 'Navegar Administradores',
            'slug'           => 'administradores.index',
            'description'    => 'Listar administradores',
        ]);

        Permission::create([
            'name'           => 'Crear administradores',
            'slug'           => 'administradores.create',
            'description'    => 'Crear un administrador',
        ]);

        Permission::create([
            'name'           => 'Visualizar detalle Administrador',
            'slug'           => 'administradores.show',
            'description'    => 'Ver detalle de cada administrador',
        ]);

        Permission::create([
            'name'           => 'Editar Administrador',
            'slug'           => 'administradores.edit',
            'description'    => 'Editar un administrador',
        ]);

        Permission::create([
            'name'           => 'Eliminar Administrador',
            'slug'           => 'administradores.destroy',
            'description'    => 'Eliminar un administrador',
        ]);

        // Categorias
        Permission::create([
            'name'           => 'Navegar Categorias',
            'slug'           => 'categorias.index',
            'description'    => 'Listar Categorias',
        ]);

        Permission::create([
            'name'           => 'Crear Categorias',
            'slug'           => 'categorias.create',
            'description'    => 'Crear una Categoria',
        ]);

        Permission::create([
            'name'           => 'Visualizar detalle Categorias',
            'slug'           => 'categorias.show',
            'description'    => 'Ver detalle de cada Categoria',
        ]);

        Permission::create([
            'name'           => 'Editar Administrador',
            'slug'           => 'categorias.edit',
            'description'    => 'Editar una Categoria',
        ]);

        Permission::create([
            'name'           => 'Eliminar Administrador',
            'slug'           => 'categorias.destroy',
            'description'    => 'Eliminar una Categoria',
        ]);
    }
}
