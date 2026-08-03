<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'ahmdalhajh79@gmail.com',
            'name' => 'Ahmed Elhaja',
            'password' => '123456789',
        ]);
    }
}
