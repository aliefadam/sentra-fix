<?php

use App\Models\Address;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

if (!function_exists("getMenuSidebar")) {
    function getMenuSidebar()
    {
        if (Auth::check()) {
            return Menu::where("role", Auth::user()->role)->get();
        }
        return;
    }
}

if (!function_exists("active_navbar")) {
    function active_navbar($url)
    {
        return request()->is($url) ? 'text-red-600' : 'text-black';
    }
}

if (!function_exists("active_sidebar")) {
    function active_sidebar($url)
    {
        return request()->is($url) || request()->is($url . '/*') ? 'text-white bg-red-600' : 'text-gray-700 hover:bg-gray-100';
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

        return $productDetail ? $productDetail : null;
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
            ->where("variant2_id", $variant2)
            // ->where("variant2_id", $variant2 ?? 0)
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

if (!function_exists("getVariantLabel")) {
    function getVariantLabel($product, $variant1_id, $variant2_id)
    {
        if (isset($request->variant2_id)) {
            $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($variant1_id)->name . " - " . getTitleVariant2($product->id) . " " . VariantDetail::find($variant2_id)->name;
        } else {
            $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($variant1_id)->name;
        }
        return $variant_label;
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
            return "Pesanan Dibatalkan";
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

if (!function_exists("getStatusStore")) {
    function getStatusStore($status)
    {
        if ($status == "waiting") {
            return "Menunggu Konfirmasi";
        } else if ($status == "active") {
            return "Aktif";
        } else if ($status == "inactive") {
            return "Tidak Aktif";
        }
    }
}

if (!function_exists("getStatusStoreBadges")) {
    function getStatusStoreBadges($status)
    {
        $color = "";
        if ($status == "waiting") {
            $color = "bg-yellow-100 text-yellow-800";
        } else if ($status == "active") {
            $color = "bg-green-100 text-green-800";
        } else if ($status == "inactive") {
            $color = "bg-red-100 text-red-800";
        }

        return "$color text-xs font-medium me-2 px-2.5 py-2 rounded-md shadow-sm";
    }
}


if (!function_exists("getStatusVoucher")) {
    function getStatusVoucher($active)
    {
        if ($active) {
            return "Aktif";
        } else {
            return "Tidak Aktif";
        }
    }
}

if (!function_exists("getStatusVoucherBadges")) {
    function getStatusVoucherBadges($active)
    {
        $color = "";
        if ($active) {
            $color = "bg-green-100 text-green-800";
        } else {
            $color = "bg-red-100 text-red-800";
        }

        return "$color text-xs font-medium me-2 px-2.5 py-2 rounded-md shadow-sm";
    }
}

if (!function_exists("getRole")) {
    function getRole()
    {
        if (Auth::check()) {
            return Auth::user()->role;
        }

        return;
    }
}

if (!function_exists("filterProduct")) {
    function filterProduct($request)
    {
        $filteredData = [];
        $productIds = [];

        // Filtering berdasarkan warna
        if ($request->has("colors")) {
            $products = [];

            foreach ($request->colors as $color) {
                $variant1 = Variant::find(1)->variantDetails()->where("name", $color)->first()->products_variant_1 ?? [];
                $variant2 = Variant::find(2)->variantDetails()->where("name", $color)->first()->products_variant_2 ?? [];

                array_push($products, $variant1, $variant2);
            }

            $products = array_filter($products);
            foreach ($products as $group) {
                foreach ($group as $item) {
                    if (!in_array($item['product_id'], $productIds)) {
                        $filteredData[$item['product_id']] = $item->product;
                        $productIds[] = $item['product_id'];
                    }
                }
            }
        }

        // Filtering berdasarkan harga
        if ($request->has("price_range")) {
            $price_range = 0;
            $price_type = "";
            $start_price = 0;
            $end_price = 0;

            if (str_contains(
                $request->price_range,
                "above"
            )) {
                $price_range = explode("_", $request->price_range)[1];
                $price_type = "above";
            } else if (str_contains($request->price_range, "below")) {
                $price_range = explode("_", $request->price_range)[1];
                $price_type = "below";
            } else {
                $start_price = explode("_", $request->price_range)[0];
                $end_price = explode("_", $request->price_range)[1];
            }

            $priceFilteredProducts = [];

            if ($price_range != 0) {
                if ($price_type == "above") {
                    $priceFilteredProducts = ProductDetail::where("price", ">", $price_range)->get();
                } else {
                    $priceFilteredProducts = ProductDetail::where("price", "<", $price_range)->get();
                }
            } else {
                $priceFilteredProducts = ProductDetail::whereBetween("price", [$start_price, $end_price])->get();
            }

            $priceFilteredData = [];
            foreach ($priceFilteredProducts as $item) {
                $productId = $item['product_id'];
                if (!isset($priceFilteredData[$productId]) || $item['price'] < $priceFilteredData[$productId]['price']) {
                    $priceFilteredData[$productId] = $item->product;
                }
            }

            // Jika sebelumnya dilakukan filtering berdasarkan warna, maka kita ambil irisan dari kedua hasil filter
            if ($request->has("colors")) {
                $filteredData = array_intersect_key($filteredData, $priceFilteredData);
            } else {
                $filteredData = $priceFilteredData;
            }
        }

        $products = array_values($filteredData);
        return $products;
    }
}


if (!function_exists("getCarts")) {
    function getCarts()
    {
        if (Auth::check()) {
            return Cart::where("user_id", Auth::user()->id)->limit(3)->get();
        }
    }
}


if (!function_exists("getCartCount")) {
    function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where("user_id", Auth::user()->id)->count();
        }
    }
}

if (!function_exists("getTransactionOneYear")) {
    function getTransactionOneYear()
    {
        $months = range(1, 12);
        $transactions = TransactionDetail::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(id) as total_transactions'),
            DB::raw('SUM(total) as total_revenue')
        )
            ->where("store_id", Auth::user()->id)
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->keyBy('month');

        $monthlyTransactions = collect($months)->map(function ($month) use ($transactions) {
            return [
                'month' => $month,
                'total_transactions' => $transactions[$month]->total_transactions ?? 0,
                'total_revenue' => $transactions[$month]->total_revenue ?? 0.0,
            ];
        });

        return $monthlyTransactions;
    }
}

if (!function_exists("getTransactionByCategory")) {
    function getTransactionByCategory()
    {
        $storeId = Auth::user()->id;

        $transactionsPerCategory = Category::select(
            'categories.id',
            'categories.name',
            DB::raw('COUNT(transactions.id) as total_transactions')
        )
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->leftJoin('transaction_details', function ($join) use ($storeId) {
                $join->on('products.name', '=', 'transaction_details.product_name')
                    ->where('transaction_details.store_id', '=', $storeId);
            })
            ->leftJoin('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_transactions')
            ->get();

        return $transactionsPerCategory;
    }
}

if (!function_exists("getTopSelling")) {
    function getTopSelling()
    {
        $top3BestSellingProducts = Product::select(
            'products.id',
            'products.name',
            'product_details.image',
            DB::raw('SUM(transaction_details.qty) as total_sold')
        )
            ->where("user_id", Auth::user()->id)
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('transaction_details', 'products.name', '=', 'transaction_details.product_name')
            ->groupBy('products.id', 'products.name', 'product_details.image')
            ->orderByDesc('total_sold')
            ->limit(3)
            ->get();

        $uniqueData = [];
        foreach ($top3BestSellingProducts as $item) {
            $uniqueData[$item['name']] = $item;
        }

        $uniqueData = array_values($uniqueData);
        return $uniqueData;
    }
}

if (!function_exists("latestTransactions")) {
    function latestTransactions()
    {
        return Transaction::whereHas("transactionDetails", function ($detail) {
            $detail->where("store_id", Auth::user()->id);
        })->limit(3)->get();
    }
}

if (!function_exists("track_packet")) {
    function track_packet($waybill, $courier)
    {
        $response = Http::post("https://pro.rajaongkir.com/api/waybill", [
            "key" => env("RAJA_ONGKIR_API_KEY"),
            "waybill" => $waybill,
            "courier" => $courier,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data["rajaongkir"]["result"])) {
                return $data["rajaongkir"]["result"];
            }
        }

        return [];
    }
}
