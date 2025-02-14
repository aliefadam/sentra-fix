<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            "name" => "Wireless Headphone",
            "slug" => "wireless-headphone",
            "category_id" => 4,
            "description" => "<p>Testing Audio</p>",
        ]);

        ProductDetail::create([
            "product_id" => 1,
            "variant1_id" => 7,
            "variant2_id" => null,
            "sku" => "WIRELESS HEADPHONE-HITAM-NONE",
            "price" => 100000,
            "stock" => 10,
            "image" => "Wireless Headphone_0_250214042208.png",
        ]);

        ProductDetail::create([
            "product_id" => 1,
            "variant1_id" => 9,
            "variant2_id" => null,
            "sku" => "WIRELESS HEADPHONE-ABU-ABU-NONE",
            "price" => 100000,
            "stock" => 10,
            "image" => "Wireless Headphone_1_250214042208.png",
        ]);
    }
}
