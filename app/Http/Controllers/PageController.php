<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ShippingStatus;
use App\Models\SubCategory;
use App\Models\Transaction;
use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome', [
            "title" => "Beranda",
            "categories" => Category::limit(6)->get(),
            "products" => Product::latest()->limit(4)->get(),
            "featured_products" => Product::limit(4)->get(),
        ]);
    }

    public function products(Request $request)
    {
        $products = [];
        if ($request->has("colors") || $request->has("price_range")) {
            $products = filterProduct($request);
        } else {
            $products = Product::all();
        }
        return view('frontend.products', [
            "title" => "Daftar Produk",
            "products" => $products,
            "selectedColors" => $request->colors,
            "selectedPrice" => $request->price_range,
            "colors" => Variant::find(1)->variantDetails,
        ]);
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $variants = [];

        foreach ($product->productDetails as $detail) {
            $variants[getTitleVariant1($product->id)][] = [
                "id" => $detail->variant1_id,
                "label" => $detail->variant1->name,
                "image" => $detail->image
            ];

            if ($detail->variant2) {
                $variants[getTitleVariant2($product->id)][] = [
                    "id" => $detail->variant2_id,
                    "label" => $detail->variant2->name,
                    "image" => $detail->image
                ];
            }
        }

        $variants[getTitleVariant1($product->id)] = array_values(array_intersect_key(
            $variants[getTitleVariant1($product->id)],
            array_unique(array_column($variants[getTitleVariant1($product->id)], 'id'))
        ));

        if (isset($product->productDetails[0]->variant2)) {
            $variants[getTitleVariant2($product->id)] = array_values(array_intersect_key(
                $variants[getTitleVariant2($product->id)],
                array_unique(array_column($variants[getTitleVariant2($product->id)], 'id'))
            ));
        }

        return view('frontend.product', [
            "title" => "Produk",
            "product" => $product,
            "variants" => $variants,
        ]);
    }

    public function product_checkout($slug, Request $request)
    {
        $product = Product::where('slug', $slug)->first();
        $store_city_id = json_decode($product->user->addresses()->first()->city)->id;
        if (isset($request->variant2_id)) {
            $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($request->variant1_id)->name . " - " . getTitleVariant2($product->id) . " " . VariantDetail::find($request->variant2_id)->name;
        } else {
            $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($request->variant1_id)->name;
        }

        return view('frontend.checkout', [
            "title" => "Checkout",
            "products" => [
                (object)[
                    "id" => $product->id,
                    "user_id" => $product->user_id,
                    "name" => $product->name,
                    "qty" => $request->qty,
                    "variant1-id" => $request->variant1_id,
                    "variant2-id" => $request->variant2_id ?? null,
                    "variant_label" => $variant_label,
                    "price" => getProductPrice($product->id, $request->variant1_id, $request->variant2_id),
                    "total" => $request->qty * getProductPrice($product->id, $request->variant1_id, $request->variant2_id),
                    "image" => getProduct($product->id, $request->variant1_id, $request->variant2_id)->image
                ]
            ],
            "store_city_id" => $store_city_id,
            "addresses" => Address::where("user_id", Auth::user()->id)->get(),
            "active_address" => Address::where("user_id", Auth::user()->id)->where("is_active", true)->first(),
        ]);
    }

    public function payment_waiting($invoice)
    {
        $transaction = Transaction::where("invoice", $invoice)->first();
        return view("frontend.payment-waiting", [
            "title" => "Menunggu Pembayaran",
            "transaction" => $transaction,
        ]);
    }

    public function categories()
    {
        return view("frontend.categories", [
            "title" => "Kategori",
            "categories" => Category::all(),
        ]);
    }

    public function category($slug)
    {
        $category = Category::where("slug", $slug)->first();
        if (!$category) {
            $category = SubCategory::where("slug", $slug)->first();
        }

        $products = $category->products;

        return view("frontend.category", [
            "title" => "Kategori",
            "category" => $category,
            "products" => $products,
        ]);
    }

    public function about()
    {
        return view("frontend.about", [
            "title" => "Tentang Kami",
        ]);
    }

    public function profile()
    {
        return view("frontend.profile", [
            "title" => "Profil",
        ]);
    }

    public function change_password()
    {
        return view("frontend.change-password", [
            "title" => "Ganti Password",
        ]);
    }

    public function transaction()
    {
        return view("frontend.transaction", [
            "title" => "Transaksi",
            "transactions" => Transaction::where("user_id", Auth::user()->id)->get(),
        ]);
    }

    public function cart()
    {
        return view("frontend.cart", [
            "title" => "Keranjang",
        ]);
    }

    public function simulate_payment()
    {
        return view("simulate-payment");
    }
    public function simulate_payment_store(Request $request)
    {
        $transaction = Transaction::where("invoice", $request->invoice)->first();
        if ($transaction) {
            $transaction->update([
                "status" => "success",
            ]);
            ShippingStatus::create([
                "transaction_id" => $transaction->id,
                "title" => "Pembayaran Diterima - Menunggu Konfirmasi",
            ]);
            return redirect()->back()->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Pembayaran berhasil dilakukan",
            ]);
        } else {
            return redirect()->back()->with("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => "Transaksi tidak ditemukan",
            ]);
        }
    }

    public function register_seller()
    {
        return view("frontend.register-seller", [
            "title" => "Pendaftaran Seller",
            "categories" => Category::all(),
        ]);
    }

    public function dashboard()
    {
        return view("backend.dashboard", [
            "title" => "Dashboard",
        ]);
    }
}
