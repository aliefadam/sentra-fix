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
            "user_id" => 3,
            "name" => "Wireless Headphone",
            "slug" => "wireless-headphone",
            "category_id" => 2,
            "sub_category_id" => 6,
            "description" => '<p>Wireless Headphone Pro menghadirkan pengalaman mendengarkan musik yang luar biasa dengan teknologi noise cancelling terbaru. Dilengkapi dengan:</p><ul><li>Driver 40mm dengan kualitas suara premium</li><li>Active Noise Cancelling untuk meredam suara luar</li><li>Baterai tahan hingga 30 jam</li><li>Konektivitas Bluetooth 5.0</li><li>Desain ergonomis dengan bahan premium</li></ul><p>&nbsp;</p><p>&nbsp;</p>',
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
