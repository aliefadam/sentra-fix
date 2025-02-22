<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "menu",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "dashboard",
            "route" => "admin.dashboard",
            "icon" => "fas fa-home",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "akun",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "pengguna",
            "route" => "admin.user.index",
            "icon" => "fas fa-user",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "seller",
            "route" => "admin.seller.index",
            "icon" => "fas fa-store",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "master data",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "produk",
            "route" => "admin.product.index",
            "icon" => "fas fa-box",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "varian",
            "route" => "admin.variant.index",
            "icon" => "fas fa-list",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "kategori",
            "route" => "admin.category.index",
            "icon" => "fas fa-list",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "transaksi",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "pesanan",
            "route" => "admin.transaction.index",
            "icon" => "fas fa-shopping-cart",
        ]);


        // Seller
        $newMenu = Menu::create([
            "role" => "seller",
            "name" => "menu",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "dashboard",
            "route" => "seller.dashboard",
            "icon" => "fas fa-home",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "Toko saya",
            "route" => "seller.store.edit",
            "icon" => "fas fa-store",
        ]);

        $newMenu = Menu::create([
            "role" => "seller",
            "name" => "master data",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "produk",
            "route" => "seller.product.index",
            "icon" => "fas fa-box",
        ]);

        $newMenu = Menu::create([
            "role" => "seller",
            "name" => "transaksi",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "pesanan",
            "route" => "seller.transaction.index",
            "icon" => "fas fa-shopping-cart",
        ]);
    }
}
