<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view("backend.product.index", [
            "title" => "Produk",
            "products" => Product::all(),
        ]);
    }

    public function create()
    {
        return view("backend.product.create", [
            "title" => "Tambah Produk",
            "sub_categories" => SubCategory::all(),
            "variants" => Variant::all(),
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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
}
