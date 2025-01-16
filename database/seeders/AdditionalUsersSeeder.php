<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdditionalUsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Employee',
                'email' => 'employee@example.com',
                'password' => Hash::make('123'),
                'role_id' => 2, // Pracownik
            ],
            [
                'name' => 'Client',
                'email' => 'client@example.com',
                'password' => Hash::make('123'),
                'role_id' => 3, // Klient
            ],
        ]);
    }
}
