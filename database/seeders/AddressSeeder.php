<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Address::create([
            "user_id" => 1,
            "name" => "Sentra Fix Address",
            "recipient" => "Sentra Fix Recipient",
            "phone" => "081234567890",
            "province" => json_encode([
                "id" => "11",
                "name" => "Jawa Timur",
            ]),
            "city" => json_encode([
                "id" => "444",
                "name" => "Surabaya"
            ]),
            "sub_district" => json_encode([
                "id" => "6132",
                "name" => "Benowo"
            ]),
            "postal_code" => "909090",
            "address" => "Testing",
            "is_active" => true,
        ]);

        Address::create([
            "user_id" => 3,
            "name" => "Adam Store Address",
            "recipient" => "Adam Store Recipient",
            "phone" => "081234567890",
            "province" => json_encode([
                "id" => "11",
                "name" => "Jawa Timur",
            ]),
            "city" => json_encode([
                "id" => "255",
                "name" => "Malang"
            ]),
            "sub_district" => json_encode([
                "id" => "3613",
                "name" => "Kepanjen"
            ]),
            "postal_code" => "909090",
            "address" => "Testing",
            "is_active" => true,
        ]);
    }
}
