<?php

use App\state;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        state::create([
            'name'              => 'Aguascalientes',
        ]);
        state::create([
            'name'              => 'Baja California',
        ]);
        state::create([
            'name'              => 'Baja California Sur',
        ]);
        state::create([
            'name'              => 'Campeche',
        ]);
        state::create([
            'name'              => 'Coahuila',
        ]);
        state::create([
            'name'              => 'Colima',
        ]);
        state::create([
            'name'              => 'Chiapas',
        ]);
        state::create([
            'name'              => 'Chihuahua',
        ]);
        state::create([
            'name'              => 'Distrito Federal',
        ]);
        state::create([
            'name'              => 'Durango',
        ]);
        state::create([
            'name'              => 'Guanajuato',
        ]);
        state::create([
            'name'              => 'Guerrero',
        ]);
        state::create([
            'name'              => 'Hidalgo',
        ]);
        state::create([
            'name'              => 'Jalisco',
        ]);
        state::create([
            'name'              => 'Ciudad de México',
        ]);
        state::create([
            'name'              => 'Michoacán',
        ]);
        state::create([
            'name'              => 'Morelos',
        ]);
        state::create([
            'name'              => 'Nayarit',
        ]);
        state::create([
            'name'              => 'Nuevo León',
        ]);
        state::create([
            'name'              => 'Oaxaca',
        ]);
        state::create([
            'name'              => 'Puebla',
        ]);
        state::create([
            'name'              => 'Querétaro',
        ]);
        state::create([
            'name'              => 'Quintana Roo',
        ]);
        state::create([
            'name'              => 'San Luis Potosí',
        ]);
        state::create([
            'name'              => 'Sinaloa',
        ]);
        state::create([
            'name'              => 'Sonora',
        ]);
        state::create([
            'name'              => 'Tabasco',
        ]);
        state::create([
            'name'              => 'Tamaulipas',
        ]);
        state::create([
            'name'              => 'Tlaxcala',
        ]);
        state::create([
            'name'              => 'Veracruz',
        ]);
        state::create([
            'name'              => 'Yucatán',
        ]);
        state::create([
            'name'              => 'Zacatecas',
        ]);
    }
}
