<?php

namespace App\Http\Controllers;

use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    private $file;
    private $role;

    public function __construct()
    {
        $this->file = Auth::user() && Auth::user()->role == "admin" ? "variant" : "seller-variant";
        $this->role = Auth::user()->role;
    }

    public function index()
    {
        return view("backend.{$this->file}.index", [
            "title" => "Varian",
            "variants" => Variant::all(),
        ]);
    }

    public function create()
    {
        return view("backend.{$this->file}.create", [
            "title" => "Tambah Variant",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $newVariant = Variant::create([
                "name" => $request->name,
            ]);

            foreach ($request->detail_variant_name as $name) {
                VariantDetail::create([
                    "variant_id" => $newVariant->id,
                    "name" => $name
                ]);
            }
            DB::commit();

            return redirect()->route("{$this->role}.variant.index")->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Varian berhasil ditambahkan",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $variant_details = Variant::find($id)->variantDetails;
        return response()->json([
            "variant_details" => $variant_details,
        ])->setStatusCode(200);
    }

    public function edit($id)
    {
        $variant = Variant::find($id);

        return view("backend.{$this->file}.edit", [
            "title" => "Edit Varian {$variant->name}",
            "variant" => $variant,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $variant = Variant::find($id);
            $variant->update([
                "name" => $request->name,
            ]);

            $variant_details = $variant->variantDetails;
            foreach ($variant_details as $index => $variant_detail) {
                $variant_detail->update([
                    "name" => $request->detail_variant_name_old[$index],
                ]);
            }

            if ($request->has("detail_variant_name")) {
                foreach ($request->detail_variant_name as $name) {
                    VariantDetail::create([
                        "variant_id" => $variant->id,
                        "name" => $name,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route("{$this->role}.variant.index")->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Variant berhasil disimpan",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        $variant = Variant::find($id);
        $variant->variantDetails->each(function ($variantDetail) {
            $variantDetail->delete();
        });
        $variant->delete();

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Varian berhasil dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ])->setStatusCode(200);
    }
}
