<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::create([
            "user_id" => 1,
            "name" => "Sentra Fix",
            "slug" => Str::slug("Sentra Fix"),
            "description" => "Toko Original Sentra Fix",
            "category" => json_encode(["1", "2"]),
            "image" => "logo-sentra-fix-removebg-preview.png",
            "status" => "active",
        ]);

        Store::create([
            "user_id" => 2,
            "name" => "Adam Store",
            "slug" => Str::slug("Adam Store"),
            "description" => "Testing",
            "category" => json_encode(["1", "2"]),
            "image" => "Adam_STORE_250217060117.png",
            "status" => "active",
        ]);
    }
}
