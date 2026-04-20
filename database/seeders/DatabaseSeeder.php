<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@petshop.com',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User default
        DB::table('users')->insert([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
            AdminSeeder::class,
        ]);
    }
}
