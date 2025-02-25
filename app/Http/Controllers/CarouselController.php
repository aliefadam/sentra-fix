<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        return view("backend.carousel.index", [
            "title" => "Pengaturan Carousel",
            "carousels" => Carousel::all(),
        ]);
    }

    public function update(Request $request)
    {
        if ($request->hasFile("carousel_new")) {
            foreach ($request->file("carousel_new") as $index => $file) {
                $fileName = "CAROUSEL_" . date("Ymdhis") . "{$index}." . $file->extension();
                $file->move(public_path("uploads/carousels"), $fileName);
                Carousel::create([
                    "image" => $fileName,
                ]);
            }
        }

        if ($request->hasFile("carousel_old")) {
            foreach ($request->file("carousel_old") as $id => $file) {
                if ($file != null) {
                    $fileName = "CAROUSEL_" . date("Ymdhis") . "{$id}." . $file->extension();
                    $file->move(public_path("uploads/carousels"), $fileName);
                    Carousel::find($id)->update([
                        "image" => $fileName,
                    ]);
                }
            }
        }

        return back()->with("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Perubahan Disimpan",
        ]);
    }

    public function destroy($id)
    {
        $carousel = Carousel::find($id);
        $carousel->delete();

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Carousel Berhasil Dihapus",
        ]);
        return response()->json([
            "message" => "success",
        ]);
    }
}
