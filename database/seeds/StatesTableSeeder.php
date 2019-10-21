<?php

use App\State;
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
        State::create([
            'name'              => 'Aguascalientes',
        ]);
        State::create([
            'name'              => 'Baja California',
        ]);
        State::create([
            'name'              => 'Baja California Sur',
        ]);
        State::create([
            'name'              => 'Campeche',
        ]);
        State::create([
            'name'              => 'Coahuila',
        ]);
        State::create([
            'name'              => 'Colima',
        ]);
        State::create([
            'name'              => 'Chiapas',
        ]);
        State::create([
            'name'              => 'Chihuahua',
        ]);
        State::create([
            'name'              => 'Distrito Federal',
        ]);
        State::create([
            'name'              => 'Durango',
        ]);
        State::create([
            'name'              => 'Guanajuato',
        ]);
        State::create([
            'name'              => 'Guerrero',
        ]);
        State::create([
            'name'              => 'Hidalgo',
        ]);
        State::create([
            'name'              => 'Jalisco',
        ]);
        State::create([
            'name'              => 'Ciudad de México',
        ]);
        State::create([
            'name'              => 'Michoacán',
        ]);
        State::create([
            'name'              => 'Morelos',
        ]);
        State::create([
            'name'              => 'Nayarit',
        ]);
        State::create([
            'name'              => 'Nuevo León',
        ]);
        State::create([
            'name'              => 'Oaxaca',
        ]);
        State::create([
            'name'              => 'Puebla',
        ]);
        State::create([
            'name'              => 'Querétaro',
        ]);
        State::create([
            'name'              => 'Quintana Roo',
        ]);
        State::create([
            'name'              => 'San Luis Potosí',
        ]);
        State::create([
            'name'              => 'Sinaloa',
        ]);
        State::create([
            'name'              => 'Sonora',
        ]);
        State::create([
            'name'              => 'Tabasco',
        ]);
        State::create([
            'name'              => 'Tamaulipas',
        ]);
        State::create([
            'name'              => 'Tlaxcala',
        ]);
        State::create([
            'name'              => 'Veracruz',
        ]);
        State::create([
            'name'              => 'Yucatán',
        ]);
        State::create([
            'name'              => 'Zacatecas',
        ]);
    }
}
