<?php

namespace App\Http\Controllers;

use App\Models\VariantDetail;
use Illuminate\Http\Request;

class VariantDetailController extends Controller
{
    public function destroy($id)
    {
        VariantDetail::find($id)->delete();
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Detail Varian berhasil dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ])->setStatusCode(200);
    }
}
