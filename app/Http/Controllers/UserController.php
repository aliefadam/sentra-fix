<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view("backend.user.index", [
            "title" => "Daftar Pengguna",
            "users" => User::where([
                ["role", "!=", "admin"],
                ["role", "!=", "seller"],
            ])->get(),
        ]);
    }

    public function create()
    {
        return response()->json([]);
    }

    public function store(Request $request)
    {
        return response()->json([]);
    }

    public function show($id)
    {
        return response()->json([]);
    }

    public function edit($id)
    {
        return response()->json([]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([]);
    }

    public function destroy($id)
    {
        return response()->json([]);
    }
}
