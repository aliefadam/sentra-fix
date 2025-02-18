<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SubCategory;
use App\Models\Variant;
use App\Models\VariantDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $file;
    private $role;

    public function __construct()
    {
        $this->file = Auth::user() && Auth::user()->role == "admin" ? "product" : "seller-product";
        $this->role = Auth::user()->role;
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $products = Product::all();
        } else {
            $products = Product::where("user_id", $user->id)->get();
        }
        return view("backend.{$this->file}.index", [
            "title" => "Produk",
            "products" => $products,
        ]);
    }

    public function create()
    {
        return view("backend.{$this->file}.create", [
            "title" => "Tambah Produk",
            "sub_categories" => SubCategory::all(),
            "variants" => Variant::all(),
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        $user_id = Auth::user()->id;
        try {
            $newProduct = Product::create([
                "user_id" => $user_id,
                "name" => $request->name,
                "slug" => str()->slug($request->name),
                "category_id" => SubCategory::find($request->category)->category->id,
                "sub_category_id" => $request->category,
                "description" => $request->description,
            ]);

            foreach ($request->file('price_img') as $index => $file) {
                $extension = $file->extension();
                $image_name = $newProduct->name . "_" . $index . "_" . date("ymdhis") . "." . $extension;
                $file->move(public_path("uploads/products"), $image_name);

                $variant1Name = VariantDetail::find($request->variant_id_1[$index])->name;
                $variant2Name = $request->variant_id_2[$index] == "" ? "NONE" : VariantDetail::find($request->variant_id_2[$index])->name;

                ProductDetail::create([
                    "product_id" => $newProduct->id,
                    "sku" => strtoupper($newProduct->name . "-" . $variant1Name . "-" . $variant2Name),
                    "variant1_id" => $request->variant_id_1[$index],
                    "variant2_id" => $request->variant_id_2[$index] == "" ? null : $request->variant_id_2[$index],
                    "price" => $request->price[$index],
                    "stock" => $request->price_stock[$index],
                    "image" => $image_name,
                ]);
            }

            DB::commit();
            return redirect()->route("{$this->role}.product.index")->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Produk berhasil ditambahkan",
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
        //
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $variant1Selected = Variant::find($product->productDetails[0]->variant1->variant->id);
        if (isset($product->productDetails[0]->variant2)) {
            $variant2Selected = Variant::find($product->productDetails[0]->variant2->variant->id);
        } else {
            $variant2Selected = [];
        }

        return view("backend.{$this->file}.edit", [
            "title" => "Edit Produk {$product->name}",
            "product" => $product,
            "sub_categories" => SubCategory::all(),
            "variants" => Variant::all(),
            "variant1_selected" => $variant1Selected->variantDetails,
            "variant2_selected" => $variant2Selected == [] ? [] : $variant2Selected->variantDetails,
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        DB::beginTransaction();
        try {
            $product->update([
                "name" => $request->name,
                "slug" => str()->slug($request->name),
                "category_id" => SubCategory::find($request->category)->category->id,
                "sub_category_id" => $request->category,
                "description" => $request->description,
            ]);

            $productDetailsOld = $product->productDetails;
            $product->productDetails()->delete();

            if ($request->has("variant_id_1")) {
                foreach ($request->price as $index => $price) {
                    $variant1Name = VariantDetail::find($request->variant_id_1[$index])->name;
                    $variant2Name = $request->variant_id_2[$index] == "" ? "NONE" : VariantDetail::find($request->variant_id_2[$index])->name;

                    foreach ($productDetailsOld as $detail) {
                        if (
                            $detail->product_id == $product->id
                            && $detail->variant1_id == $request->variant_id_1[$index]
                            && $detail->variant2_id == $request->variant_id_2[$index]
                        ) {
                            $imageName = $detail->image;
                            if (isset($request->file('price_img')[$index])) {
                                $file = $request->file('price_img')[$index];
                                $extension = $file->extension();
                                $image_name = $product->name . "_" . $index . "_" . date("ymdhis") . "." . $extension;
                                $file->move(public_path("uploads/products"), $image_name);
                                $imageName = $image_name;
                            }

                            ProductDetail::create([
                                "product_id" => $product->id,
                                "sku" => strtoupper($product->name . "-" . $variant1Name . "-" . $variant2Name),
                                "variant1_id" => $request->variant_id_1[$index],
                                "variant2_id" => $request->variant_id_2[$index] == "" ? null : $request->variant_id_2[$index],
                                "price" => $request->price[$index],
                                "stock" => $request->price_stock[$index],
                                "image" => $imageName,
                            ]);
                        }
                    }
                }
            }

            if ($request->has("variant_id_1_new")) {
                foreach ($request->price_new as $index => $price) {
                    $file = $request->file('price_img_new')[$index];
                    $extension = $file->extension();
                    $image_name = $product->name . "_" . $index . "_" . date("ymdhis") . "." . $extension;
                    $file->move(public_path("uploads/products"), $image_name);

                    $variant1Name = VariantDetail::find($request->variant_id_1_new[$index])->name;
                    $variant2Name = $request->variant_id_2_new[$index] == "" ? "NONE" : VariantDetail::find($request->variant_id_2_new[$index])->name;

                    ProductDetail::create([
                        "product_id" => $product->id,
                        "sku" => strtoupper($product->name . "-" . $variant1Name . "-" . $variant2Name),
                        "variant1_id" => $request->variant_id_1_new[$index],
                        "variant2_id" => $request->variant_id_2_new[$index] == "" ? null : $request->variant_id_2_new[$index],
                        "price" => $request->price_new[$index],
                        "stock" => $request->price_stock_new[$index],
                        "image" => $image_name,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route("{$this->role}.product.index")->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Produk berhasil disimpan",
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
        $product = Product::find($id);
        $product->productDetails()->delete();
        $product->delete();

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Produk berhasil dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ])->setStatusCode(200);
    }

    public function price_form($id, Request $request)
    {
        $product = Product::find($id);
        return response()->json([
            "html" => view("components.price-form-edit-product-container", [
                "product" => $product,
                "variant1" => $request->dataVariants1,
                "variant2" => $request->dataVariants2 ?? [],
            ])->render(),
        ])->setStatusCode(200);
    }

    public function get_stock($productID, $variant1, $variant2)
    {
        $product = ProductDetail::where("product_id", $productID)
            ->where("variant1_id", $variant1)
            ->where("variant2_id", $variant2 == "null" ? null : $variant2)
            ->first();

        return response()->json([
            "price" => format_rupiah($product->price, true),
            "stock" => $product->stock,
            "image" => $product->image
        ])->setStatusCode(200);
    }
}
