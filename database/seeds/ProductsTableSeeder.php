<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::create([
            'name'        => 'Producto 1',
            'description' => 'Descripción del producto 1',
            'category_id' => 1,
            'stock'       => 12,
            'sale_price' => 36.90
        ]);
    }
}
