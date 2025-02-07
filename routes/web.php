<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PageController::class, "home"])->name("home");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/product/{slug}/checkout", [PageController::class, "product_checkout"])->name("product.checkout");
Route::get("/payment-waiting/{invoice}", [PageController::class, "payment_waiting"])->name("payment.waiting");

Route::get("/categories", [PageController::class, "categories"])->name("categories");
Route::get("/category/{slug}", [PageController::class, "category"])->name("category");

Route::get("/about", [PageController::class, "about"])->name("about");
