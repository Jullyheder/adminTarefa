<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('teste123'),
                'nameComplete' => 'Admin Administrador',
                'mod_id' => 1,
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 2,
                'name' => 'user1',
                'email' => 'user1@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('teste123'),
                'nameComplete' => 'User1 Usuario1',
                'mod_id' => 2,
                'remember_token' => Str::random(10)
            ],
            [
                'id' => 3,
                'name' => 'user2',
                'email' => 'user2@email.com',
                'email_verified_at' => now(),
                'password' => Hash::make('teste123'),
                'nameComplete' => 'User2 Usuario2',
                'mod_id' => 2,
                'remember_token' => Str::random(10)
            ]
        ]);
    }
}
