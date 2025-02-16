<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function province()
    {
        $response = Http::get("https://pro.rajaongkir.com/api/province", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
        ]);

        return response()->json($response->json()["rajaongkir"]["results"]);
    }

    public function city($provinceID)
    {

        $response = Http::get("https://pro.rajaongkir.com/api/city", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "province" => $provinceID
        ]);

        return response()->json($response->json()["rajaongkir"]["results"]);
    }

    public function subdistrict($cityID)
    {
        $response = Http::get("https://pro.rajaongkir.com/api/subdistrict", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "city" => $cityID
        ]);

        return response()->json($response->json()["rajaongkir"]["results"]);
    }

    public function getShippingCost(Request $request)
    {
        $response = Http::post("https://pro.rajaongkir.com/api/cost", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "origin" => $request->origin,
            "originType" => "city",
            "destination" => $request->destination,
            "destinationType" => "subdistrict",
            "weight" => 2000,
            "courier" => $request->courier,
        ]);

        return response()->json($response->json()["rajaongkir"]["results"][0]["costs"]);
    }
}
