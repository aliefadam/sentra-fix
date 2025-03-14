<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function destroy($id)
    {
        SubCategory::find($id)->delete();
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Sub Kategori berhasil dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ])->setStatusCode(200);
    }
}
