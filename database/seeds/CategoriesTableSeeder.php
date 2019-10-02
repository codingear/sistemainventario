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
            'name'  =>  'Categoría 1',
            'description'   =>  'Descripción 1',
        ]);
        Category::create([
            'name'  =>  'Categoría 2',
            'description'   =>  'Descripción 2',
        ]);
        Category::create([
            'name'  =>  'Categoría 3',
            'description'   =>  'Descripción 3',
        ]);
        Category::create([
            'name'  =>  'Categoría 4',
            'description'   =>  'Descripción 4',
        ]);
    }
}
