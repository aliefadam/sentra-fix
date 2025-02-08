<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', [
            "title" => "Login",
        ]);
    }

    public function login_post(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ], [
            "email.required" => "Email wajib diisi",
            "email.email" => "Email tidak valid",
            "password.required" => "Password wajib diisi",
        ]);

        if (Auth::attempt($request->only("email", "password"))) {
            $role = Auth::user()->role;
            if ($role == "admin") {
                return redirect()->route("admin.dashboard");
            } else {
                return redirect()->route("home");
            }
        }

        return back()->with("notification", [
            "icon" => "error",
            "title" => "Gagal",
            "text" => "Username atau password salah",
        ]);
    }

    public function register()
    {
        return view('auth.register', [
            "title" => "Register",
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
}
