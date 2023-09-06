<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'nom' => 'Admin',
                'prenom' => 'Admin',
                'cin' => 'XA112233',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 0,
            ],
            [
                'nom' => 'Chef',
                'prenom' => 'Filiere',
                'cin' => 'XA445566',
                'email' => 'chef@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 1,
            ],
            [
                'nom' => 'Prof',
                'prenom' => 'Prof',
                'cin' => 'XA778899',
                'email' => 'prof@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 2,
            ],
        ]);
    }
}
