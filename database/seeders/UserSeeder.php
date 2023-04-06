<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'level' => 'admin',
        ]);
        User::create([
            'name' => 'Saya',
            'email' => 'saya@gmail.com',
            'password' => bcrypt('saya12345'),
        ]);
        User::create([
            'name' => 'Kamu',
            'email' => 'kamu@gmail.com',
            'password' => bcrypt('kamu12345'),
        ]);
    }
}
