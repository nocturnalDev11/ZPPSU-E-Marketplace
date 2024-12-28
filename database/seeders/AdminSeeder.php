<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
<<<<<<< HEAD
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
=======
            'email' => 'zppsu.emarketplace@gmail.com',
            'password' => Hash::make('admin123'),
>>>>>>> 9f64e7b045f88b60a0adb93d761525d625705b92
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
