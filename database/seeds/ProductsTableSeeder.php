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
            'name'              => 'Producto 1',
            'sku'               => '00750105530568',
            'description'       => 'Compra en línea el agua 20 l., para que prepares agua con frutas de temporada o bébela simple, mantén hidratada a tu familia. Cómpralos en línea y recíbelos en la comodidad de tu hogar.',
            'category_id'       => 1,
            'stock'             => 12,
            'sale_price'        => 36.90
        ]);

        Product::create([
            'name'              => 'Producto 2',
            'sku'               => '13750196530123',
            'description'       => 'Compra en línea el agua 20 l., para que prepares agua con frutas de temporada o bébela simple, mantén hidratada a tu familia. Cómpralos en línea y recíbelos en la comodidad de tu hogar.',
            'category_id'       => 2,
            'stock'             => 5,
            'sale_price'        => 150.99
        ]);
    }
}
