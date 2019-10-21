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

        // proveedores
        Permission::create([
            'name' => 'Navegar Proveedores',
            'slug' => 'proveedores.index',
            'description' => 'Listar proveedores',
        ]);

        Permission::create([
            'name' => 'Crear Proveedores',
            'slug' => 'proveedores.create',
            'description' => 'Crear un proveedor',
        ]);

        Permission::create([
            'name' => 'Visualizar detalle Proveedor',
            'slug' => 'proveedores.show',
            'description' => 'Ver detalle de cada proveedores',
        ]);

        Permission::create([
            'name' => 'Editar Proveedor',
            'slug' => 'proveedores.edit',
            'description' => 'Editar un proveedores',
        ]);

        Permission::create([
            'name' => 'Eliminar Proveedor',
            'slug' => 'proveedores.destroy',
            'description' => 'Eliminar un proveedores',
        ]);

        // productos
        Permission::create([
            'name' => 'Navegar Productos',
            'slug' => 'productos.index',
            'description' => 'Listar productos',
        ]);

        Permission::create([
            'name' => 'Crear Producto',
            'slug' => 'productos.create',
            'description' => 'Crear un producto',
        ]);

        Permission::create([
            'name' => 'Visualizar detalle producto',
            'slug' => 'productos.show',
            'description' => 'Ver detalle de cada producto',
        ]);

        Permission::create([
            'name' => 'Editar producto',
            'slug' => 'productos.edit',
            'description' => 'Editar un producto',
        ]);

        Permission::create([
            'name' => 'Eliminar producto',
            'slug' => 'productos.destroy',
            'description' => 'Eliminar un producto',
        ]);
    }
}
