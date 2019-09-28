<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superAdmin = User::create([
            'name'              => 'Luis Macias',
            'email'             => 'admin@equibra.com',
            'password'          => Hash::make('981010'),
            'change_password'   => true
        ]);

        $superAdmin->assignRoles('superAdministrador');
    }
}
