<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ShippingStatus;
use App\Models\SubCategory;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome', [
            "title" => "Beranda",
            "categories" => Category::limit(6)->get(),
            "products" => Product::latest()->limit(4)->get(),
            "featured_products" => Product::limit(4)->get(),
            "carousels" => Carousel::all(),
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

    public function product_checkout_post($slug, Request $request)
    {
        $user_id = Auth::user()->id;
        $product = Product::where('slug', $slug)->first();
        $store_city_id = json_decode($product->user->addresses()->first()->city)->id;
        if (isset($request->variant2_id)) {
            $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($request->variant1_id)->name . " - " . getTitleVariant2($product->id) . " " . VariantDetail::find($request->variant2_id)->name;
        } else {
            $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($request->variant1_id)->name;
        }

        session()->put("user_checkout_{$user_id}", [
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
                    "image" => getProduct($product->id, $request->variant1_id, $request->variant2_id)->image,
                    "weight" => getProduct($product->id, $request->variant1_id, $request->variant2_id)->weight,
                ]
            ],
            "store_city_id" => $store_city_id,
            "addresses" => Address::where("user_id", Auth::user()->id)->get(),
            "active_address" => Address::where("user_id", Auth::user()->id)->where("is_active", true)->first(),
        ]);

        return response()->json([
            "redirect_url" => route("product.checkout", $product->slug),
        ]);
    }

    public function product_checkout($slug, Request $request)
    {
        $user_id = Auth::user()->id;
        $dataCheckout = session("user_checkout_{$user_id}");
        $dataCheckout["addresses"] = Address::where("user_id", Auth::user()->id)->get();
        $dataCheckout["active_address"] = Address::where("user_id", Auth::user()->id)->where("is_active", true)->first();
        session()->put("user_checkout_{$user_id}", $dataCheckout);

        return view('frontend.checkout', [
            "title" => "Checkout",
            "products" => $dataCheckout["products"],
            "store_city_id" => $dataCheckout["store_city_id"],
            "addresses" => $dataCheckout["addresses"],
            "active_address" => $dataCheckout["active_address"],
            "voucher" => isset($dataCheckout["voucher"]) ? $dataCheckout["voucher"] : [],
        ]);
    }

    public function payment_waiting($invoice)
    {
        $transaction = Transaction::where("invoice", $invoice)->first();
        if ($transaction->payment_status == "waiting") {
            return view("frontend.payment-waiting", [
                "title" => "Menunggu Pembayaran",
                "transaction" => $transaction,
            ]);
        } else {
            return redirect()->route("payment.success", $transaction->invoice);
        }
    }

    public function payment_success($invoice)
    {
        $transaction = Transaction::where("invoice", $invoice)->first();
        return view("frontend.payment-success", [
            "title" => "Pembayaran Sukses",
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
            "user" => Auth::user(),
        ]);
    }

    public function profile_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $updatedData = [
            "name" => $request->name,
            "phone" => $request->phone,
            "date_of_birth" => $request->date_of_birth,
            "gender" => $request->gender,
        ];
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = "USER_IMAGE_" . strtoupper($user->name) . "_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/users"), $fileName);
            $updatedData["image"] = $fileName;
        }

        $user->update($updatedData);
        return redirect()->back()->with("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Profil berhasil diperbarui",
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
            "transactions" => Transaction::where("user_id", Auth::user()->id)->latest()->get(),
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
                "payment_status" => "success",
            ]);
            $transaction->transactionDetails()->update([
                "shipping_status" => "success",
            ]);
            foreach ($transaction->transactionDetails as $detail) {
                ShippingStatus::create([
                    "transaction_id" => $transaction->id,
                    "transaction_detail_id" => $detail->id,
                    "title" => "Pembayaran Diterima - Menunggu Konfirmasi",
                ]);
            }
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

    public function search(Request $request)
    {
        $query = $request->q;
        $products = [];

        if (!empty($query)) {
            Product::where("name", "like", "%$query%")->orWhereHas("subCategory", function ($category) use ($query) {
                $category->where("name", "like", "%$query%");
            })->get()->each(function ($product) use (&$products) {
                array_push($products, $product);
            });
        } else {
            return redirect()->route("home");
        }

        return view("frontend.search", [
            "title" => "Pencarian Produk",
            "products" => $products,
            "query" => $query,
        ]);
    }

    public function dashboard()
    {
        $user = User::find(Auth::user()->id);

        $data_admin = [
            "transaction_count" => TransactionDetail::where("store_id", $user->id)->count(),
            "income" => TransactionDetail::where("store_id", $user->id)
                ->where("shipping_status", "done")
                ->sum("total"),
            "buyer_count" => User::where([
                ["role", "!=", "admin"],
                ["role", "!=", "seller"],
            ])->count(),
            "product_count" => $user->products()->count(),
            "transaction_per_month" => getTransactionOneYear(),
            "transaction_by_category" => getTransactionByCategory(),
            "top_3_best_selling_products" => getTopSelling(),
            "latest_transactions" => latestTransactions(),
            "waiting_status_count" => TransactionDetail::where("store_id", $user->id)->where("shipping_status", "waiting")->count(),
            "delivery_status_count" => TransactionDetail::where("store_id", $user->id)->where("shipping_status", "delivery")->count(),
            "done_status_count" => TransactionDetail::where("store_id", $user->id)->where("shipping_status", "done")->count(),
        ];

        $data_seller = [
            "transaction_count" => TransactionDetail::where("store_id", $user->id)->count(),
            "income" => TransactionDetail::where("store_id", $user->id)
                ->where("shipping_status", "done")
                ->sum("total"),
            "buyer_count" => User::where([
                ["role", "!=", "admin"],
                ["role", "!=", "seller"],
            ])->count(),
            "product_count" => $user->products()->count(),
            "transaction_per_month" => getTransactionOneYear(),
            "transaction_by_category" => getTransactionByCategory(),
            "top_3_best_selling_products" => getTopSelling(),
            "latest_transactions" => latestTransactions(),
            "waiting_status_count" => TransactionDetail::where("store_id", $user->id)->where("shipping_status", "waiting")->count(),
            "delivery_status_count" => TransactionDetail::where("store_id", $user->id)->where("shipping_status", "delivery")->count(),
            "done_status_count" => TransactionDetail::where("store_id", $user->id)->where("shipping_status", "done")->count(),
        ];

        return view("backend.dashboard", [
            "title" => "Dashboard",
            "categories" => Category::all(),
            "dashboard" => $user->role == "admin" ? $data_admin : $data_seller,
        ]);
    }
}
