<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome', [
            "title" => "Beranda",
        ]);
    }

    public function products()
    {
        return view('frontend.products', [
            "title" => "Daftar Produk",
        ]);
    }

    public function product($slug)
    {
        return view('frontend.product', [
            "title" => "Produk",
        ]);
    }

    public function product_checkout($slug)
    {
        return view('frontend.checkout', [
            "title" => "Checkout",
        ]);
    }

    public function payment_waiting($invoice)
    {
        return view("frontend.payment-waiting", [
            "title" => "Menunggu Pembayaran",
        ]);
    }

    public function categories()
    {
        return view("frontend.categories", [
            "title" => "Kategori",
        ]);
    }

    public function category($slug)
    {
        return view("frontend.category", [
            "title" => "Kategori",
        ]);
    }

    public function about()
    {
        return view("frontend.about", [
            "title" => "Tentang Kami",
        ]);
    }

    public function profile()
    {
        return view("frontend.profile", [
            "title" => "Profil",
        ]);
    }

    public function change_password()
    {
        return view("frontend.change-password", [
            "title" => "Ganti Password",
        ]);
    }

    public function transaction()
    {
        return view("frontend.transaction", [
            "title" => "Transaksi",
        ]);
    }

    public function cart()
    {
        return view("frontend.cart", [
            "title" => "Keranjang",
        ]);
    }

    public function dashboard()
    {
        return view("backend.dashboard", [
            "title" => "Dashboard",
        ]);
    }
}
