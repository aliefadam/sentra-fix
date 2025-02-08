<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/login", [AuthController::class, "login_post"])->name("login.post");
Route::get("/register", [AuthController::class, "register"])->name("register");
Route::post("/register", [AuthController::class, "register_post"])->name("register.post");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::get("/", [PageController::class, "home"])->name("home");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/product/{slug}/checkout", [PageController::class, "product_checkout"])->name("product.checkout");
Route::get("/payment-waiting/{invoice}", [PageController::class, "payment_waiting"])->name("payment.waiting");

Route::get("/categories", [PageController::class, "categories"])->name("categories");
Route::get("/category/{slug}", [PageController::class, "category"])->name("category");

Route::get("/about", [PageController::class, "about"])->name("about");

Route::get("/profile", [PageController::class, "profile"])->name("profile");
Route::get("/profile/change-password", [PageController::class, "change_password"])->name("profile.change-password");
Route::get("/transaction", [PageController::class, "transaction"])->name("transaction");

Route::get("/cart", [PageController::class, "cart"])->name("cart");

Route::prefix("admin")->group(function () {
    Route::get("/dashboard", [PageController::class, "dashboard"])->name("admin.dashboard");
});
