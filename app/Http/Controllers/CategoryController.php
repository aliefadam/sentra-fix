<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index', [
            "title" => "Kategori",
            "categories" => Category::all(),
        ]);
    }

    public function create()
    {
        return view("backend.category.create", [
            "title" => "Tambah Kategori",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $newCategory = Category::create([
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "icon" => $request->icon,
            ]);
            foreach ($request->sub_category_name as $name) {
                SubCategory::create([
                    "category_id" => $newCategory->id,
                    "name" => $name,
                    "slug" => Str::slug($name),
                ]);
            }
            DB::commit();
            return redirect()->route("admin.category.index")->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Kategori berhasil ditambahkan",
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
        // Display the specified resource
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        return view("backend.category.edit", [
            "title" => "Edit Kategori {$categories->name}",
            "category" => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->update([
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "icon" => $request->icon,
            ]);

            $sub_categories = $category->subCategories;
            foreach ($sub_categories as $index => $sub_category) {
                $sub_category->update([
                    "name" => $request->sub_category_name_old[$index],
                ]);
            }

            if ($request->has("sub_category_name")) {
                foreach ($request->sub_category_name as $name) {
                    SubCategory::create([
                        "category_id" => $category->id,
                        "name" => $name,
                        "slug" => Str::slug($name),
                    ]);
                }
            }

            DB::commit();
            return redirect()->route("admin.category.index")->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Kategori berhasil disimpan",
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
        $category = Category::find($id);
        $category->subCategories->each(function ($subCategory) {
            $subCategory->delete();
        });
        $category->delete();

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Kategori berhasil dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ])->setStatusCode(200);
    }
}
