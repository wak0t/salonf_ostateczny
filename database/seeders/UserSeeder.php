<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('123'),
    'role_id' => 1, // Zakładając, że 1 to ID roli "Admin"
	]);

    }
}
