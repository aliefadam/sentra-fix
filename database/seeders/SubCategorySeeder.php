<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create([
            "category_id" => 1,
            "name" => "Pakaian Pria",
            "slug" => Str::slug("Pakaian Pria"),
        ]);
        SubCategory::create([
            "category_id" => 1,
            "name" => "Pakaian Wanita",
            "slug" => Str::slug("Pakaian Wanita"),
        ]);
        SubCategory::create([
            "category_id" => 1,
            "name" => "Sepatu",
            "slug" => Str::slug("Sepatu"),
        ]);
        SubCategory::create([
            "category_id" => 1,
            "name" => "Tas & Aksesoris",
            "slug" => Str::slug("Tas & Aksesoris"),
        ]);

        SubCategory::create([
            "category_id" => 2,
            "name" => "Smartphone",
            "slug" => Str::slug("Smartphone"),
        ]);
        SubCategory::create([
            "category_id" => 2,
            "name" => "Audio & Speaker",
            "slug" => Str::slug("Audio & Speaker"),
        ]);
        SubCategory::create([
            "category_id" => 2,
            "name" => "Laptop & Komputer",
            "slug" => Str::slug("Laptop & Komputer"),
        ]);
        SubCategory::create([
            "category_id" => 2,
            "name" => "Aksesoris Elektronik",
            "slug" => Str::slug("Aksesoris Elektronik"),
        ]);

        SubCategory::create([
            "category_id" => 3,
            "name" => "Perabotan Rumah",
            "slug" => Str::slug("Perabotan Rumah"),
        ]);
        SubCategory::create([
            "category_id" => 3,
            "name" => "Dapur",
            "slug" => Str::slug("Dapur"),
        ]);
        SubCategory::create([
            "category_id" => 3,
            "name" => "Kamar Tidur",
            "slug" => Str::slug("Kamar Tidur"),
        ]);
        SubCategory::create([
            "category_id" => 3,
            "name" => "Dekorasi",
            "slug" => Str::slug("Dekorasi"),
        ]);

        SubCategory::create([
            "category_id" => 4,
            "name" => "Suplemen",
            "slug" => Str::slug("Suplemen"),
        ]);
        SubCategory::create([
            "category_id" => 4,
            "name" => "Alat Kesehatan",
            "slug" => Str::slug("Alat Kesehatan"),
        ]);
        SubCategory::create([
            "category_id" => 4,
            "name" => "Perawatan Tubuh",
            "slug" => Str::slug("Perawatan Tubuh"),
        ]);
        SubCategory::create([
            "category_id" => 4,
            "name" => "Masker & Sanitizer",
            "slug" => Str::slug("Masker & Sanitizer"),
        ]);

        SubCategory::create([
            "category_id" => 5,
            "name" => "Konsol Game",
            "slug" => Str::slug("Konsol Game"),
        ]);
        SubCategory::create([
            "category_id" => 5,
            "name" => "Video Game",
            "slug" => Str::slug("Video Game"),
        ]);
        SubCategory::create([
            "category_id" => 5,
            "name" => "Aksesoris Gaming",
            "slug" => Str::slug("Aksesoris Gaming"),
        ]);
        SubCategory::create([
            "category_id" => 5,
            "name" => "Gaming Gear",
            "slug" => Str::slug("Gaming Gear"),
        ]);

        SubCategory::create([
            "category_id" => 6,
            "name" => "Alat Pel",
            "slug" => Str::slug("Alat Pel"),
        ]);
        SubCategory::create([
            "category_id" => 6,
            "name" => "Asbak",
            "slug" => Str::slug("Asbak"),
        ]);
    }
}
