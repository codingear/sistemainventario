<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) use ($factory){
    return [
        'name' => $faker->sentence(2),
        'sku' => $faker->randomNumber(8),
        'category_id' => Category::inRandomOrder()->value('id'),
        'description' => $faker->paragraph(),
        'status' => 'Publicado',
        'principal_image' => null,
        'stock' => $faker->numberBetween(10,500),
        'sale_price' => $faker->randomElement(['1.50', '450', '40.99','81.30','30','80','300','10800']),
    ];
});
