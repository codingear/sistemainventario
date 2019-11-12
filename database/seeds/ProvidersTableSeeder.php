<?php

use Illuminate\Database\Seeder;
use App\Provider;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Provider::create([
            'name' => 'LuisDev',
            'contact_name' => 'Luis Romero Pasten',
            'email' => 'luis@gmail.com',
            'rfc' => 'LUISPASTEN123',
            'address' => 'Avenida Lopez 123',
            'zip_code' => '12345',
            'state_id' => 9,
            'city' => 'Ciudad de México',
            'telephone' => '5552123456',
            'website' => 'luispasten.dev',
            'notes' => 'Notas'
        ]);

        Provider::create([
            'name' => 'IsidroDev',
            'contact_name' => 'Isidro Martínez',
            'email' => 'isidro@gmail.com',
            'rfc' => 'ISIDROMARI123',
            'address' => 'Avenida Lopez 123',
            'zip_code' => '12345',
            'state_id' => 11,
            'city' => 'León',
            'telephone' => '4776663025',
            'website' => 'Isidrom.dev',
            'notes' => 'Notas'
        ]);
    }
}
