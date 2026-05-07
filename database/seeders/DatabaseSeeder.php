<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ranajit Rakshit',
            'email' => 'msdranajit@gmail.com',
            'password' => Hash::make('ranajit2003'),
            'role' => 'admin',
        ]);
        
        User::create([
            'name' => 'Timothy VL Ruatdika',
            'email' => 'timothyvlruatdika@gmail.com',
            'password' => Hash::make('timothy2004'), 
            'role' => 'admin',
        ]);
    }
}