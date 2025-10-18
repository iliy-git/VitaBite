<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'VitaBite Admin',
            'email' => 'aaa@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('11111111'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);
    }
}
