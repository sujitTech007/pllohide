<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!Admin::where('email','admin@pllohide.local')->exists()) {
            Admin::create([
                'name' => 'Admin',
                'email' => 'admin@pllohide.local',
                'password' => Hash::make('Admin@12345'),
            ]);
        }
    }
}
