<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            "originType" => $request->originType,
            "destination" => $request->destination,
            "destinationType" => $request->destinationType,
            "weight" => $request->weight,
            "courier" => $request->courier,
        ]);

        return response()->json($response->json()["rajaongkir"]["results"][0]["costs"]);
    }

    public function getShippingCostShipment(Request $request)
    {
        $data = [];
        foreach ($request->data_shipment as $shipment) {
            $response = Http::post("https://pro.rajaongkir.com/api/cost", [
                "key" => env("RAJA_ONGKIR_API_KEY"),
                "origin" => $shipment["store_city_id"],
                "originType" => $request->originType,
                "destination" => $request->destination,
                "destinationType" => $request->destinationType,
                "weight" => $shipment["weight"],
                "courier" => $request->courier,
            ]);

            array_push($data, $response->json()["rajaongkir"]["results"][0]["costs"]);
        }

        return response()->json($data);
    }
}
