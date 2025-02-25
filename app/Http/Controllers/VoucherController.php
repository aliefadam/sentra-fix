<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    private $file;
    private $role;

    public function __construct()
    {
        $this->file = Auth::user() && Auth::user()->role == "admin" ? "voucher" : "seller-voucher";
        $this->role = Auth::user()->role;
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $vouhcers = Voucher::all();
        } else {
            $vouhcers = Voucher::where("user_id", $user->id)->get();
        }

        return view("backend.{$this->file}.index", [
            "title" => "Daftar Voucher",
            "vouchers" => $vouhcers,
        ]);
    }

    public function create()
    {
        return view("backend.{$this->file}.create", [
            "title" => "Tambah Voucher",
        ]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        Voucher::create([
            "user_id" => $user_id,
            "available_for" => $request->available_for,
            "code" => $request->code,
            "unit" => $request->unit ?? null,
            "nominal" => $request->nominal ?? null,
            "minimal_transaction" => $request->minimal_transaction,
            "maximal_used" => $request->maximal_used,
        ]);

        return redirect()->route("{$this->role}.voucher.index")->with("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Menambahkan Voucher",
        ]);
    }

    public function show(Request $request, $session_name)
    {
        try {
            $voucher = Voucher::firstWhere("code", $request->code);
            if ($voucher) {
                $total_transaction = $request->total_transaction;
                $shipping_cost = $request->shipping_cost;

                if ($total_transaction < $voucher->minimal_transaction) {
                    throw new \Exception("Total pembelian tidak mencukupi untuk menggunakan voucher ini");
                }

                if (!$voucher->active) {
                    throw new \Exception("Voucher ini sudah kadaluarsa atau tidak aktif");
                }

                $is_used_by_you = Transaction::where([
                    ["user_id", "=", Auth::user()->id],
                    ["promo_code", "=", $voucher->code]
                ])->count();

                if ($is_used_by_you > 0) {
                    throw new \Exception("Voucher ini sudah pernah anda gunakan");
                }

                $discount = 0;
                $discount_label = "";
                if ($voucher->available_for == "Diskon Total Transaksi") {
                    if ($voucher->unit == "Persen") {
                        $nominal = $voucher->nominal;
                        $discount_label = "{$nominal}%";
                        $discount = ($total_transaction * $nominal) / 100;
                    } else {
                        $discount = $voucher->nominal;
                    }
                } else {
                    $discount = $shipping_cost;
                }
                $dataVoucher = [
                    "code" => $voucher->code,
                    "discount" => $discount,
                    "discount_label" => $discount_label,
                ];

                $newDataCheckout = session($session_name);
                $newDataCheckout["voucher"] = $dataVoucher;
                session()->put($session_name, value: $newDataCheckout);
                session()->flash("notification", [
                    "icon" => "success",
                    "title" => "Berhasil",
                    "text" => "Voucher berhasil digunakan",
                ]);
                return response()->json(["message" => "success"]);
            } else {
                throw new \Exception("Kode voucher tidak ditemukan");
            }
        } catch (\Exception $e) {
            session()->flash("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
            return response()->json(["message" => "error"]);
        }
    }

    public function cancel_promo($session_name)
    {
        $dataCheckout = session()->get($session_name);
        $dataCheckout["voucher"] = [];
        session()->put($session_name, value: $dataCheckout);
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Promo dihapus",
        ]);
        return response()->json(["message" => "success"]);
    }

    public function edit($id)
    {
        $voucher = Voucher::find($id);
        return view("backend.{$this->file}.edit", data: [
            "title" => "Edit Voucher",
            "voucher" => $voucher,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $voucher = Voucher::find($id);
        $voucher->update([
            "available_for" => $request->available_for,
            "code" => $request->code,
            "unit" => $request->unit ?? null,
            "nominal" => $request->nominal ?? null,
            "minimal_transaction" => $request->minimal_transaction,
            "maximal_used" => $request->maximal_used,
        ]);

        return redirect()->route("{$this->role}.voucher.index")->with("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Menambahkan Voucher",
        ]);
    }

    public function destroy($id)
    {
        $voucher = Voucher::find($id);
        $voucher->delete();

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Voucher berhasil dihapus",
        ]);

        return response()->json(["message" => "success"]);
    }

    public function deactivate($id)
    {
        Voucher::find($id)->update(["active" => false]);
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Voucher berhasil dinonaktifkan",
        ]);

        return response()->json(["message" => "success"]);
    }

    public function activate($id)
    {
        Voucher::find($id)->update(["active" => true]);
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Voucher berhasil diaktifkan",
        ]);

        return response()->json(["message" => "success"]);
    }
}
