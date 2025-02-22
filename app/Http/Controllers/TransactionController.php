<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingStatus;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Auth::user()->store->transactions;
        return view("backend.transaction.index", [
            "title" => "Transaksi",
            "transactions" => $transactions,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $products = json_decode($request->products);
        $invoice = "INV-SENTRAFIX-" . Str::upper(Str::random(10)) .  Auth::user()->id . "-" . date("ymdhis");

        $total = 0;
        foreach ($products as $index => $product) {
            $shipping_cost = explode("_", $request->input("shipping"))[2];
            $total += ($product->qty * $product->price) + $shipping_cost;
        }

        $payment_name = explode("_", $request->method_payment)[1];
        $payment_type = explode("_", $request->method_payment)[0];
        $payment_data = 909090909090909090;

        try {
            DB::beginTransaction();
            $newTransaction = Transaction::create([
                "invoice" => $invoice,
                "user_id" => Auth::user()->id,
                "shipping_address" => getDetailAddress(),
                "payment" => json_encode([
                    "name" => $payment_name,
                    "type" => $payment_type,
                    "data" => $payment_data,
                ]),
                "total" => $total,
                "status" => "waiting",
                "due_date" => now()->addDays()
            ]);

            foreach ($products as $i => $product) {
                $shipping_service = explode("_", $request->input("shipping"))[0];
                $shipping_cost = explode("_", $request->input("shipping"))[2];
                $store_id = Product::find($product->id)->user->store->id;
                TransactionDetail::create([
                    "transaction_id" => $newTransaction->id,
                    "store_id" => $store_id,
                    "product_name" => $product->name,
                    "product_image" => $product->image,
                    "product_price" => $product->price,
                    "qty" => $product->qty,
                    "variant" => $product->variant_label,
                    "shipping_cost" => $shipping_cost,
                    "shipping_service" => $shipping_service,
                    "sub_total" => $product->total,
                    "total" => ($product->qty * $product->price) + $shipping_cost,
                    "notes" => $request->notes[$index],
                ]);
            }

            DB::commit();
            return response()->json([
                "message" => "success",
                "invoice" => $newTransaction->invoice,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
            return response()->json([
                "message" => "error",
            ]);
        }
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        return response()->json([
            "html" => view("components.modal-detail-transaction", [
                "transaction" => $transaction
            ])->render(),
            "transaction" => $transaction,
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function transaction_from_shipment(Request $request)
    {
        $payment_name = explode("_", $request->method_payment)[1];
        $payment_type = explode("_", $request->method_payment)[0];
        $payment_data = 909090909090909090;

        $products = json_decode($request->products);
        $store_id = 0;
        $total = 0;
        try {
            DB::beginTransaction();

            foreach ($products as $index => $product) {
                $shipping_cost = explode("_", $request->input("shipping-{$index}"))[2];
                $total += ($product->qty * $product->price) + $shipping_cost;
            }

            $invoice = "INV-SENTRAFIX-" . Str::upper(Str::random(10)) .  Auth::user()->id . "-" . date("ymdhis");
            $newTransaction = Transaction::create([
                "invoice" => $invoice,
                "user_id" => Auth::user()->id,
                "shipping_address" => getDetailAddress(),
                "payment" => json_encode([
                    "name" => $payment_name,
                    "type" => $payment_type,
                    "data" => $payment_data,
                ]),
                "total" => $total,
                "status" => "waiting",
                "due_date" => now()->addDays()
            ]);

            foreach ($products as $index => $product) {
                $shipping_service = explode("_", $request->input("shipping-{$index}"))[0];
                $shipping_cost = explode("_", $request->input("shipping-{$index}"))[2];
                $store_id = Product::find($product->id)->user->store->id;
                TransactionDetail::create([
                    "transaction_id" => $newTransaction->id,
                    "store_id" => $store_id,
                    "product_name" => $product->name,
                    "product_image" => $product->image,
                    "product_price" => $product->price,
                    "qty" => $product->qty,
                    "variant" => $product->variant_label,
                    "shipping_cost" => $shipping_cost,
                    "shipping_service" => $shipping_service,
                    "sub_total" => $product->total,
                    "total" => ($product->qty * $product->price) + $shipping_cost,
                    "notes" => $request->notes[$index],
                ]);
            }

            DB::commit();
            return response()->json([
                "message" => "success",
                "invoice" => $newTransaction->invoice,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
            return response()->json([
                "message" => "error",
                "text" => $e->getMessage(),
            ]);
        }
    }

    public function confirm($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            "status" => "confirmed",
        ]);
        ShippingStatus::create([
            "transaction_id" => $transaction->id,
            "title" => "Pesanan telah dikonfirmasi",
        ]);

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Pesanan berhasil dikonfirmasi",
        ]);
        return response()->json([
            "message" => "success",
        ]);
    }

    public function delivery($id, Request $request)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            "status" => "delivery",
            "shipping_code" => $request->resi,
        ]);
        ShippingStatus::create([
            "transaction_id" => $transaction->id,
            "title" => "Pesanan telah diserahkan ke pihak jasa kirim",
        ]);

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Pesanan berhasil dikirimkan",
        ]);
        return response()->json([
            "message" => "success",
        ]);
    }

    public function done($id)
    {
        try {
            $transaction = Transaction::find($id);
            $transaction->update([
                "status" => "done",
            ]);
            ShippingStatus::create([
                "transaction_id" => $transaction->id,
                "title" => "Pesanan telah diterima pembeli",
            ]);

            session()->flash("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Pesanan berhasil dikonfirmasi",
            ]);
            return response()->json([
                "message" => "success",
            ]);
        } catch (\Exception $e) {
            session()->flash("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
            return response()->json([
                "message" => "error",
            ]);
        }
    }
}
