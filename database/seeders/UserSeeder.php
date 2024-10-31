<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Lutreze Hue Jacinto',
            'email' => 'jacintolutrezehue@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'John Cena',
            'email' => 'john@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
