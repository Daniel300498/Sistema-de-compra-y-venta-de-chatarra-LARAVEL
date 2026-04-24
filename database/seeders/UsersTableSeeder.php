<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'Super Administrador',
            'email'    => 'superadmin@gmail.com',
            'password' => '9876543210*',
            'estado'   => true,
        ])->assignRole('superadmin');
    }
}
