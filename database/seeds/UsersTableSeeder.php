<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name'              => 'Luis Macias',
            'email'             => 'admin@equibra.com',
            'password'          => bcrypt('981010'),
        ]);

        $user->assignRoles('superAdministrador');
    }
}
