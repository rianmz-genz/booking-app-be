<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'test@gmail.com',
            'fullname' => 'test',
            'is_active' => true,
            'phone' => '088122718',
            'password' => Hash::make('password')
        ]);
      
    }
}
