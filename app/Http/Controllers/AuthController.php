<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
            } else if ($role == "seller") {
                $seller = Auth::user();
                if ($seller->status == "waiting") {
                    return back()->with("notification", [
                        "icon" => "error",
                        "title" => "Gagal",
                        "text" => "Akun seller anda belum dikonfirmasi oleh admin",
                    ]);
                } else {
                    return redirect()->route("seller.dashboard");
                }
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

    public function register_post(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
        ], [
            "name.required" => "Nama wajib diisi",
            "email.required" => "Email wajib diisi",
            "email.email" => "Email tidak valid",
            "email.unique" => "Email sudah terdaftar",
            "password.required" => "Password wajib diisi",
            "password.confirmed" => "Konfirmasi Password tidak sama",
        ]);

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
            "role" => "user",
        ]);

        return redirect()->route("login")->with("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Pendaftaran Akun Sukses",
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->email)->first();
        if ($user) {
            $user->update([
                'google_id' => $googleUser->id,
                'name' => $googleUser->name,
                "role" => "user",
                'password' => bcrypt("{$googleUser->id}-{$googleUser->email}-{$googleUser->name}"),
            ]);
        } else {
            $user = User::create([
                'google_id' => $googleUser->id,
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                "role" => "user",
                'password' => bcrypt("{$googleUser->id}-{$googleUser->email}-{$googleUser->name}"),
            ]);
        }

        Auth::login($user);
        return redirect()->route('home');
    }

    public function forgot_password()
    {
        return view("auth.forgot-password", [
            "title" => "Lupa Password",
        ]);
    }

    public function forgot_password_post(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status == "passwords.user") {
            return back()->with("message", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => "Email anda belum terdaftar di situs kami",
            ]);
        }

        return redirect()->route("forgot-password-done");
    }

    public function forgot_password_done()
    {
        return view("auth.forgot-password-done", [
            "title" => "Lupa Password Berhasil",
        ]);
    }

    public function reset_password($token)
    {
        return view("auth.reset-password", [
            "title" => "Reset Password",
            "token" => $token,
        ]);
    }

    public function reset_password_post(Request $request)
    {
        if ($request->password != $request->password_confirmation) {
            return back()->with("message", [
                "icon" => "error",
                "title" => "Gagal",
                "text" => "Konfirmasi Password Tidak Sesuai"
            ]);
        }

        Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return redirect()->route("login")->with("message", [
            "icon" => "success",
            "title" => "Gagal",
            "text" => "Berhasil Mereset Password, Silahkan Login!"
        ]);
    }

    public function change_password_post(Request $request)
    {
        $request->validate([
            "old_password" => "required|current_password",
            "password" => "required|confirmed",
        ], [
            "old_password.required" => "Password Lama wajib diisi",
            "old_password.current_password" => "Password Lama Tidak Sesuai",
            "password.required" => "Password Baru wajib diisi",
            "password.confirmed" => "Konfirmasi Password Tidak Sesuai",
        ]);

        $user = User::find(Auth::user()->id);
        $user->update([
            "password" => bcrypt($request->password)
        ]);

        Auth::logout();
        return redirect()->route("login")->with("notification", [
            "icon" => "success",
            "title" => "Berhasil",
            "text" => "Password Berhasil Diubah, silahkan login kembali"
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("home");
    }
}
