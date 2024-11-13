<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'admin',
            'email' => 'admin2024@gmail.com',
            'password' => bcrypt('smkn1kawali'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'petugas',
            'email' => 'petugas2024@gmail.com',
            'password' => bcrypt('smkn1kawali'),
            'role' => 'petugas',
        ]);
        User::create([
            'name' => 'pimpinan',
            'email' => 'pimpinan2024@gmail.com',
            'password' => bcrypt('smkn1kawali'),
            'role' => 'pimpinan',
        ]);
        User::create([
            'name' => 'konsumen',
            'email' => 'konsumen2024@gmail.com',
            'password' => bcrypt('smkn1kawali'),
            'role' => 'konsumen',
        ]);
    }
}
