<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin; 
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cek jika admin sudah ada, agar tidak duplicate
        if (!Admin::where('email', 'admin@petshop.com')->exists()) {
            Admin::create([
                'username' => 'Admin',
                'email' => 'admin@petshop.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
        }
    }
}
