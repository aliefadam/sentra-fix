<?php

namespace App\Http\Controllers;

use App\Models\ImageProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageProductController extends Controller
{
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $imageProduct = ImageProduct::find($id);
            $imageProduct->delete();
            DB::commit();
            session()->put("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Gambar berhasil dihapus",
            ]);
            return response()->json([
                "message" => "success",
            ])->setStatusCode(200);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->put("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
            return response()->json([
                "message" => $e->getMessage(),
            ], 400);
        }
    }
}
