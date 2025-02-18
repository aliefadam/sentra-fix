<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Fashion",
            "slug" => Str::slug("Fashion"),
            "icon" => "fas fa-tshirt",
        ]);

        Category::create([
            "name" => "Elektronik",
            "slug" => Str::slug("Elektronik"),
            "icon" => "fas fa-mobile-alt",
        ]);

        Category::create([
            "name" => "Rumah Tangga",
            "slug" => Str::slug("Rumah Tangga"),
            "icon" => "fas fa-home",
        ]);

        Category::create([
            "name" => "Kesehatan",
            "slug" => Str::slug("Kesehatan"),
            "icon" => "fas fa-heartbeat",
        ]);

        Category::create([
            "name" => "Gaming",
            "slug" => Str::slug("Gaming"),
            "icon" => "fas fa-gamepad",
        ]);

        Category::create([
            "name" => "Kebersihan",
            "slug" => Str::slug("Kebersihan"),
            "icon" => "fa-regular fa-broom-wide",
        ]);
    }
}
