<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  =>  'Garrafones',
            'description'   =>  'Descripción Garrafones',
        ]);
        Category::create([
            'name'  =>  'Insumos',
            'description'   =>  'Descripción Insumos',
        ]);
        Category::create([
            'name'  =>  'Repuestos',
            'description'   =>  'Descripción Repuestos',
        ]);
        Category::create([
            'name'  =>  'Tuberías',
            'description'   =>  'Descripción Tuberías',
        ]);
    }
}
