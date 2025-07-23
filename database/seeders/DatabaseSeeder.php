<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('adminjarkom2025'), // Gantilah dengan password yang diinginkan
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        $this->call(\Database\Seeders\AdminSeeder::class);
    }
}
