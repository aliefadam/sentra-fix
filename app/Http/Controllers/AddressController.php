<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rajaongkir = getRajaOngkir($request->subdistrict);

            $user = User::find(Auth::user()->id);
            $user->address()->update([
                "is_active" => false,
            ]);
            Address::create([
                "user_id" => $user->id,
                "name" => $request->name,
                "recipient" => $request->recipient,
                "phone" => $request->phone,
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

            session()->flash("notification", [
                "icon" => "success",
                "title" => "Berhasil",
                "text" => "Alamat berhasil ditambahkan",
            ]);
            return response()->json([
                "status" => "success",
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("notification", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => $e->getMessage(),
            ]);
            return response()->json([
                "status" => "failed",
            ]);
        }
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

    public function change_address($id)
    {
        $user = User::find(Auth::user()->id);
        $user->address()->update([
            "is_active" => false,
        ]);
        $address = Address::find($id);
        $address->update([
            "is_active" => true,
        ]);
        session()->flash("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Berhasil mengganti alamat",
        ]);

        // $user_id = Auth::user()->id;
        // if (session()->has("cart_shipment_{$user_id}")) {
        //     $data = session()->get("cart_shipment_{$user_id}");
        //     foreach ($data as $key => $value) {
        //         $data[$key]["selected_address"] = $id;
        //     }
        //     session()->put("cart_shipment_{$user_id}", $data);
        // }

        return response()->json([
            "status" => "success",
        ]);
    }

    public function change_address_in_shipment($id) {}
}
