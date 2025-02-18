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
        $product = json_decode($request->products);
        $shipping_service = explode("_", $request->shipping)[0];
        $shipping_cost = explode("_", $request->shipping)[2];
        $invoice = "INV-SENTRAFIX-" . Str::upper(Str::random(10)) .  Auth::user()->id . "-" . date("ymdhis");
        $store_id = 0;

        $sub_total = 0;
        foreach ($product as $p) {
            $store_id = Product::find($p->id)->user->store->id;
            $sub_total += $p->total;
        }

        $payment_name = explode("_", $request->method_payment)[1];
        $payment_type = explode("_", $request->method_payment)[0];
        $payment_data = 909090909090909090;

        try {
            DB::beginTransaction();
            $newTransaction = Transaction::create([
                "invoice" => $invoice,
                "user_id" => Auth::user()->id,
                "store_id" => $store_id,
                "sub_total_product" => $sub_total,
                "shipping_address" => getDetailAddress(),
                "shipping_cost" => $shipping_cost,
                "shipping_service" => $shipping_service,
                "payment" => json_encode([
                    "name" => $payment_name,
                    "type" => $payment_type,
                    "data" => $payment_data,
                ]),
                "total" => $sub_total + $shipping_cost,
                "status" => "waiting",
                "due_date" => now()->addDays()
            ]);

            foreach ($product as $i => $p) {
                TransactionDetail::create([
                    "transaction_id" => $newTransaction->id,
                    "product_name" => $p->name,
                    "product_image" => $p->image,
                    "product_price" => $p->price,
                    "qty" => $p->qty,
                    "variant" => $p->variant_label,
                    "total" => $p->total,
                    "notes" => $request->notes[$i],
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
