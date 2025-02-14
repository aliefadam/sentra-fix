<?php

use App\Models\ProductDetail;

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
