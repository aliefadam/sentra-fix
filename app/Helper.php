<?php

use App\Models\Address;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Variant;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

if (!function_exists("active_navbar")) {
    function active_navbar($url)
    {
        return request()->is($url) ? 'text-pink-600' : 'text-black';
    }
}

if (!function_exists("active_sidebar")) {
    function active_sidebar($url)
    {
        return request()->is($url) || request()->is($url . '/*') ? 'text-white bg-pink-600' : 'text-gray-700 hover:bg-gray-100';
    }
}

if (!function_exists("format_rupiah")) {
    function format_rupiah($number, $withPrefix = false)
    {
        $formattedNumber = number_format($number, 0, ',', '.');
        return $withPrefix ? 'Rp ' . $formattedNumber : $formattedNumber;
    }
}

if (!function_exists("getProdutDetailCount")) {
    function getProdutDetailCount($id)
    {
        return ProductDetail::where("product_id", $id)->count();
    }
}

if (!function_exists("getProduct")) {
    function getProduct($productID, $variant1, $variant2)
    {
        $productDetail = ProductDetail::where("product_id", $productID)
            ->where("variant1_id", $variant1)
            ->where("variant2_id", $variant2)
            ->first();

        return $productDetail ? $productDetail : "";
    }
}


if (!function_exists("getProductPrice")) {
    function getProductPrice($productID, $variant1, $variant2)
    {
        $productDetail = ProductDetail::where("product_id", $productID)
            ->where("variant1_id", $variant1)
            ->where("variant2_id", $variant2)
            ->first();

        return $productDetail ? $productDetail->price : "";
    }
}

if (!function_exists("getProductStock")) {
    function getProductStock($productID, $variant1, $variant2)
    {
        $productDetail = ProductDetail::where("product_id", $productID)
            ->where("variant1_id", $variant1)
            ->where("variant2_id", $variant2)
            ->first();

        return $productDetail ? $productDetail->stock : "";
    }
}

if (!function_exists("getProductImage")) {
    function getProductImage($productID, $variant1, $variant2)
    {
        $productDetail = ProductDetail::where("product_id", $productID)
            ->where("variant1_id", $variant1)
            ->where("variant2_id", $variant2)
            ->first();

        return $productDetail ? $productDetail->image : "";
    }
}

if (!function_exists("getLowerPriceProduct")) {
    function getLowerPriceProduct($productID)
    {
        return format_rupiah(ProductDetail::where("product_id", $productID)->min('price'), true);
    }
}

if (!function_exists("getProductPrice")) {
    function getProductPrice($productID, $variant1, $variant2)
    {
        $productDetail = ProductDetail::where("product_id", $productID)
            ->where("variant1_id", $variant1)
            ->where("variant2_id", $variant2 ?? 0)
            ->first();

        return $productDetail->price;
    }
}

if (!function_exists("getTitleVariant")) {
    function getTitleVariant1($productID)
    {
        $product = Product::find($productID);
        return $product->productDetails->first()->variant1->variant->name;
    }
}

if (!function_exists("getTitleVariant2")) {
    function getTitleVariant2($productID)
    {
        $product = Product::find($productID);
        return $product->productDetails->first()->variant2 ? $product->productDetails->first()->variant2->variant->name : '';
    }
}

if (!function_exists("getProvinceName")) {
    function getProvinceName($id)
    {
        $response = Http::get("https://pro.rajaongkir.com/api/province", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "id" => $id,
        ]);

        return $response->json()["rajaongkir"]["results"]["province"];
    }
}

if (!function_exists("getCityName")) {
    function getCityName($id)
    {
        $response = Http::get("https://pro.rajaongkir.com/api/city", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "id" => $id,
        ]);

        return $response->json()["rajaongkir"]["results"]["city_name"];
    }
}

if (!function_exists("getRajaOngkir")) {
    function getRajaOngkir($subdistrictID)
    {
        $response = Http::get("https://pro.rajaongkir.com/api/subdistrict", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "id" => $subdistrictID,
        ]);

        $results = $response->json()["rajaongkir"]["results"];
        return $results;
    }
}

if (!function_exists("getDetailAddress")) {
    function getDetailAddress()
    {
        $user = Auth::user();
        $address = Address::where("user_id", $user->id)->where("is_active", true)->first();
        $province = json_decode($address->province)->name;
        $city = json_decode($address->city)->name;
        $subdistrict = json_decode($address->sub_district)->name;

        return "{$address->address}, {$subdistrict}, {$city}, {$province} ({$address->postal_code})";
    }
}

if (!function_exists("showingDays")) {
    function showingDays($date)
    {
        return Carbon::parse($date)->translatedFormat('l, d F Y - H:i:s');
    }
}

if (!function_exists("getStatus")) {
    function getStatus($status)
    {
        if ($status == "waiting") {
            return "Menunggu Pembayaran";
        } else if ($status == "success") {
            return "Pembayaran Berhasil";
        } else if ($status == "confirmed") {
            return "Pesanan dikonfirmasi";
        } else if ($status == "delivery") {
            return "Pesanan dikirim";
        } else if ($status == "done") {
            return "Pesanan selesai";
        } else {
            return "Gagal";
        }
    }
}

if (!function_exists("getStatusBadges")) {
    function getStatusBadges($status)
    {
        $color = "";
        if ($status == "waiting") {
            $color = "bg-yellow-100 text-yellow-800";
        } else if ($status == "success") {
            $color = "bg-blue-100 text-blue-800";
        } else if ($status == "confirmed") {
            $color = "bg-green-100 text-green-800";
        } else if ($status == "delivery") {
            $color = "bg-orange-100 text-orange-800";
        } else if ($status == "done") {
            $color = "bg-green-100 text-green-800";
        } else {
            $color = "bg-red-100 text-red-800";
        }

        return "$color text-xs font-medium me-2 px-2.5 py-2 rounded-md shadow-sm";
    }
}
