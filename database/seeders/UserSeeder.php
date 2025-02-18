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
            'name' => 'Sentra Fix Administrator',
            "email" => "sentrafix@admin.com",
            "password" => bcrypt("123"),
            "phone" => "90909090",
            "role" => "admin",
        ]);

        User::create([
            'name' => 'Alief',
            "email" => "aliefadam6@gmail.com",
            "password" => bcrypt("123"),
            "phone" => "081234567890",
            "role" => "user",
        ]);

        User::create([
            'name' => 'Adam',
            "email" => "aliefadam21@gmail.com",
            "password" => bcrypt("123"),
            "phone" => "081234567890",
            "role" => "seller",
        ]);
    }
}
