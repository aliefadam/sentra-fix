<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
        Cart::find($id)->delete();
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
}
