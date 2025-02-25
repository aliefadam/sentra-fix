<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index()
    {
        return view("backend.store.index", [
            "title" => "Daftar Seller",
            "stores" => Store::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ], [
            'password.required' => 'Password wajib diisi',
            "password.confirmed" => "Konfirmasi Password tidak sama",
        ]);

        DB::beginTransaction();
        try {
            $newUser = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password),
                "phone" => $request->phone,
                "role" => "seller",
            ]);

            $file = $request->file('store_image');
            $extension = $file->extension();
            $image_name = $newUser->name .  "_STORE_" . date("ymdhis") . "." . $extension;
            $file->move(public_path("uploads/stores"), $image_name);
            // $file->move(public_path("uploads/users"), $image_name);

            $newStore = Store::create([
                "user_id" => $newUser->id,
                "name" => $request->store_name,
                "slug" => Str::slug($request->store_name),
                "description" => $request->store_description,
                "category" => json_encode($request->store_category),
                "image" => $image_name,
                "status" => "waiting",
            ]);
            $newUser->update(["image" => $newStore->image]);


            $rajaongkir = getRajaOngkir($request->subdistrict);
            Address::create([
                "user_id" => $newUser->id,
                "name" => $newStore->name . " Address",
                "recipient" => $newStore->name . " Recipient",
                "phone" => $newUser->phone,
                "province" => json_encode([
                    "id" => $rajaongkir["province_id"],
                    "name" => $rajaongkir["province"],
                ]),
                "city" => json_encode([
                    "id" => $rajaongkir["city_id"],
                    "name" => $rajaongkir["city"],
                ]),
                "sub_district" => json_encode([
                    "id" => $rajaongkir["subdistrict_id"],
                    "name" => $rajaongkir["subdistrict_name"],
                ]),
                "postal_code" => $request->postal_code,
                "address" => $request->address,
                "is_active" => true,
            ]);

            DB::commit();
            return redirect()->route("store.success");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ])->withInput();
        }
    }

    public function success()
    {
        return view("frontend.register-seller-success", [
            "title" => "Pendaftaran Seller",
        ]);
    }

    public function show($slug)
    {
        $store = Store::where("slug", $slug)->first();
        return view("frontend.store", [
            "title" => "Toko {$store->name}",
            "store" => $store,
        ]);
    }

    public function show_detail($id)
    {
        $store = Store::find($id);
        return response()->json([
            "html" => view("components.modal-detail-store", [
                "store" => $store,
            ])->render(),
        ]);
    }

    public function edit()
    {
        $store = Store::where("user_id", Auth::user()->id)->first();
        return view("backend.store.edit", [
            "title" => "Toko Saya",
            "store" => $store,
            "categories" => Category::all(),
        ]);
    }

    public function update(Request $request)
    {
        $store = Store::where("user_id", Auth::user()->id)->first();

        DB::beginTransaction();
        try {

            $user = User::where("id", Auth::user()->id)->first();
            $storeUpdated = [
                "name" => $request->store_name,
                "slug" => Str::slug($request->store_name),
                "description" => $request->store_description,
                "category" => json_encode($request->store_category),
            ];

            if ($request->hasFile("store_image")) {
                $file = $request->file('store_image');
                $extension = $file->extension();
                $image_name = $user->name .  "_STORE_" . date("ymdhis") . "." . $extension;
                $file->move(public_path("uploads/stores"), $image_name);
                $storeUpdated["image"] = $image_name;
            }

            $store->update($storeUpdated);

            $rajaongkir = getRajaOngkir($request->subdistrict);
            $address = Address::where("user_id", Auth::user()->id)->where("is_active", true)->first();
            $address->update([
                "name" => $user->name . " Address",
                "recipient" => $user->name . " Recipient",
                "phone" => $user->phone,
                "province" => json_encode([
                    "id" => $rajaongkir["province_id"],
                    "name" => $rajaongkir["province"],
                ]),
                "city" => json_encode([
                    "id" => $rajaongkir["city_id"],
                    "name" => $rajaongkir["city"],
                ]),
                "sub_district" => json_encode([
                    "id" => $rajaongkir["subdistrict_id"],
                    "name" => $rajaongkir["subdistrict_name"],
                ]),
                "postal_code" => $request->postal_code,
                "address" => $request->address,
                "is_active" => true,
            ]);

            DB::commit();
            return redirect()->back()->with("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Perubahan Disimpan",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ])->withInput();
        }
    }

    public function destroy($id)
    {
        //
    }

    public function confirm($id)
    {
        $store = Store::find($id);
        $store->update(["status" => "active"]);

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Sukses",
            "text" => "Berhasil Mengkonfirmasi Seller",
        ]);

        return response()->json([
            "message" => "success",
        ]);
    }

    public function deactive($id)
    {
        $store = Store::find($id);
        $store->update(["status" => "inactive"]);

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Sukses",
            "text" => "Berhasil Menonaktifkan Seller",
        ]);

        return response()->json([
            "message" => "success",
        ]);
    }

    public function activate($id)
    {
        $store = Store::find($id);
        $store->update(["status" => "active"]);

        session()->flash("notification", [
            "icon" => "success",
            "title" => "Sukses",
            "text" => "Berhasil Mengaktifkan Seller",
        ]);

        return response()->json([
            "message" => "success",
        ]);
    }
}
