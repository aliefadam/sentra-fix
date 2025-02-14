<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Fashion",
            "icon" => "fas fa-tshirt",
        ]);

        Category::create([
            "name" => "Elektronik",
            "icon" => "fas fa-mobile-alt",
        ]);
    }
}
