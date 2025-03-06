<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\VariantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        return view("frontend.cart", [
            "title" => "Keranjang",
            "carts" => Cart::where("user_id", Auth::user()->id)->get(),
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $existingCart = Cart::where([
                ["user_id", Auth::user()->id],
                ["product_id", $request->productID],
                ["variant1_id", $request->variant1ID],
                ["variant2_id", $request->variant2ID],
            ])->first();

            if ($existingCart) {
                $existingCart->update([
                    "qty" => $existingCart->qty + $request->qty,
                ]);
            } else {
                Cart::create([
                    "user_id" => Auth::user()->id,
                    "product_id" => $request->productID,
                    "qty" => $request->qty,
                    "variant1_id" => $request->variant1ID,
                    "variant2_id" => $request->variant2ID,
                ]);
            }
            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => [
                    "icon" => "success",
                    "title" => "Berhasil",
                    "text" => "Berhasil menambahkan keranjang",
                ],
                "cart_count" => getCartCount(),
                "html_list_cart" => view("components.list-cart")->render(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => "error",
                "message" => [
                    "icon" => "error",
                    "title" => "Gagal",
                    "text" => $e->getMessage(),
                ],
                "cart_count" => getCartCount(),
                "html_list_cart" => view("components.list-cart")->render(),
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $cart = Cart::find($id)->delete();
        $cart->delete();
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Item berhasil dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ]);
    }

    public function destroy_all()
    {
        Cart::where("user_id", Auth::user()->id)->delete();

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Menghapus seluruh item",
        ]);
        return response()->json([
            "message" => "success",
        ]);
    }

    public function get_total(Request $request)
    {
        $totalHarga = 0;
        $jumlahBarang = count($request->data);

        foreach ($request->data as $data) {
            $product = getProduct($data["product_id"], $data["variant1_id"], $data["variant2_id"]);
            $totalHarga += $product->price * $data["qty"];
        }

        return response()->json([
            "total_harga" => format_rupiah($totalHarga, true),
            "jumlah_barang" => $jumlahBarang,
        ]);
    }

    public function shipment_post(Request $request)
    {
        $user_id = Auth::user()->id;
        $shipment = [];
        $shipment["products"] = [];
        foreach ($request->data as $data) {
            array_push($shipment["products"], $data);
        }
        session()->put("cart_shipment_{$user_id}", $shipment);
        // session()->put("cart_shipment_{$user_id}", $shipment);
        return response()->json([
            "redirect_url" => route("cart.shipment"),
        ]);
    }

    public function shipment()
    {
        $user_id = Auth::user()->id;
        $dataShipment = session()->get("cart_shipment_{$user_id}");
        // return $dataShipment;
        $data = [];
        $data["products"] = [];
        $data["voucher"] = isset($dataShipment["voucher"]) ? $dataShipment["voucher"] : [];
        foreach ($dataShipment["products"] as $shipment) {
            $product = Product::find($shipment["product_id"]);
            $store_city_id = json_decode($product->user->addresses()->first()->city)->id;
            if (isset($shipment["variant2_id"])) {
                $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($shipment["variant1_id"])->name . " - " . getTitleVariant2($product->id) . " " . VariantDetail::find($shipment["variant2_id"])->name;
            } else {
                $variant_label = getTitleVariant1($product->id) . " " . VariantDetail::find($shipment["variant1_id"])->name;
            }
            array_push($data["products"], (object)[
                "id" => $product->id,
                "user_id" => $product->user_id,
                "name" => $product->name,
                "qty" => $shipment["qty"],
                "variant1-id" => $shipment["variant1_id"],
                "variant2-id" => $shipment["variant2_id"] ?? null,
                "variant_label" => $variant_label,
                "price" => getProductPrice($product->id, $shipment["variant1_id"], $shipment["variant2_id"]),
                "total" => $shipment["qty"] * getProductPrice($product->id, $shipment["variant1_id"], $shipment["variant2_id"]),
                "image" => getProduct($product->id, $shipment["variant1_id"], $shipment["variant2_id"])->image,
                "weight" => getProduct($product->id, $shipment["variant1_id"], $shipment["variant2_id"])->weight,
                "store_city_id" => $store_city_id,
            ]);
            // array_push($data, (object)[
            //     "id" => $product->id,
            //     "user_id" => $product->user_id,
            //     "name" => $product->name,
            //     "qty" => $shipment["qty"],
            //     "variant1-id" => $shipment["variant1_id"],
            //     "variant2-id" => $shipment["variant2_id"] ?? null,
            //     "variant_label" => $variant_label,
            //     "price" => getProductPrice($product->id, $shipment["variant1_id"], $shipment["variant2_id"]),
            //     "total" => $shipment["qty"] * getProductPrice($product->id, $shipment["variant1_id"], $shipment["variant2_id"]),
            //     "image" => getProduct($product->id, $shipment["variant1_id"], $shipment["variant2_id"])->image,
            //     "weight" => getProduct($product->id, $shipment["variant1_id"], $shipment["variant2_id"])->weight,
            //     "store_city_id" => $store_city_id,
            // ]);
        }

        return view("frontend.shipment", [
            "title" => "Checkout",
            "products" => $data["products"],
            "addresses" => Address::where("user_id", Auth::user()->id)->get(),
            "active_address" => Address::where("user_id", Auth::user()->id)->where("is_active", true)->first(),
            "voucher" => $data["voucher"],
        ]);
    }
}
