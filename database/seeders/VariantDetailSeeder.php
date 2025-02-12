<?php

namespace Database\Seeders;

use App\Models\VariantDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariantDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VariantDetail::create(["variant_id" => 1, "name" => "Merah"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Biru"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Hijau"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Kuning"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Ungu"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Putih"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Hitam"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Coklat"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Abu-abu"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Oranye"]);
        VariantDetail::create(["variant_id" => 1, "name" => "Pink"]);

        VariantDetail::create(["variant_id" => 2, "name" => "S"]);
        VariantDetail::create(["variant_id" => 2, "name" => "M"]);
        VariantDetail::create(["variant_id" => 2, "name" => "L"]);
        VariantDetail::create(["variant_id" => 2, "name" => "XL"]);
        VariantDetail::create(["variant_id" => 2, "name" => "XXL"]);
    }
}
