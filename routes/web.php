<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\VariantDetailController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PageController::class, "home"])->name("home");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/categories", [PageController::class, "categories"])->name("categories");
Route::get("/category/{slug}", [PageController::class, "category"])->name("category");
Route::get("/about", [PageController::class, "about"])->name("about");

Route::prefix("simulate-payment")->group(function () {
    Route::get("/", [PageController::class, "simulate_payment"])->name("simulate_payment.index");
    Route::post("/", [PageController::class, "simulate_payment_store"])->name("simulate_payment.store");
});

// JQUERY FETCH
Route::get("/get-stock/{productID}/{variant1ID}/{variant2ID}", [ProductController::class, "get_stock"])->name("product.get-stock");

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "login_post"])->name("login.post");
    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "register_post"])->name("register.post");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");

    Route::post("/product/{slug}/checkout", [PageController::class, "product_checkout"])->name("product.checkout");
    Route::get("/payment-waiting/{invoice}", [PageController::class, "payment_waiting"])->name("payment.waiting");
    Route::get("/profile", [PageController::class, "profile"])->name("profile");
    Route::get("/profile/change-password", [PageController::class, "change_password"])->name("profile.change-password");
    Route::get("/cart", [PageController::class, "cart"])->name("cart");

    Route::prefix("address")->group(function () {
        Route::get("/", [AddressController::class, "index"])->name("address.index");
        Route::get("/create", [AddressController::class, "create"])->name("address.create");
        Route::post("/", [AddressController::class, "store"])->name("address.store");
        Route::get("/{id}", [AddressController::class, "edit"])->name("address.edit");
        Route::put("/{id}", [AddressController::class, "update"])->name("address.update");
        Route::put("/change/{id}", [AddressController::class, "change_address"])->name("address.change-address");
        Route::delete("/{id}", [AddressController::class, "destroy"])->name("address.destroy");
    });

    Route::prefix("rajaongkir")->group(function () {
        Route::get("province", [RajaOngkirController::class, "province"]);
        Route::get("city/{province_id}", [RajaOngkirController::class, "city"]);
        Route::get("subdistrict/{city_id}", [RajaOngkirController::class, "subdistrict"]);
        Route::post("get-shipping-cost", [RajaOngkirController::class, "getShippingCost"]);
    });

    Route::prefix("transaction")->group(function () {
        Route::get("/", [PageController::class, "transaction"])->name("transaction");
        Route::get("/{id}", [TransactionController::class, "show"])->name("transaction.show");
        Route::post("/", [TransactionController::class, "store"])->name("transaction.store");
        Route::put("/{id}/done", [TransactionController::class, "done"])->name("admin.transaction.done");
    });

    Route::prefix("admin")->group(function () {
        Route::get("/dashboard", [PageController::class, "dashboard"])->name("admin.dashboard");

        Route::prefix("category")->group(function () {
            Route::get("/", [CategoryController::class, "index"])->name("admin.category.index");
            Route::get("/create", [CategoryController::class, "create"])->name("admin.category.create");
            Route::post("/", [CategoryController::class, "store"])->name("admin.category.store");
            Route::get("/{id}", [CategoryController::class, "edit"])->name("admin.category.edit");
            Route::put("/{id}", [CategoryController::class, "update"])->name("admin.category.update");
            Route::delete("/{id}", [CategoryController::class, "destroy"])->name("admin.category.destroy");
        });
        Route::delete("/sub_category/{id}", [SubCategoryController::class, "destroy"])->name("admin.sub_category.destroy");

        Route::prefix("variant")->group(function () {
            Route::get("/", [VariantController::class, "index"])->name("admin.variant.index");
            Route::get("/create", [VariantController::class, "create"])->name("admin.variant.create");
            Route::post("/", [VariantController::class, "store"])->name("admin.variant.store");
            Route::get("/show/{id}", [VariantController::class, "show"])->name("admin.variant.show");
            Route::get("/{id}", [VariantController::class, "edit"])->name("admin.variant.edit");
            Route::put("/{id}", [VariantController::class, "update"])->name("admin.variant.update");
            Route::delete("/{id}", [VariantController::class, "destroy"])->name("admin.variant.destroy");
        });
        Route::delete("/variant_detail/{id}", [VariantDetailController::class, "destroy"])->name("admin.variant-detail.destroy");

        Route::prefix("product")->group(function () {
            Route::get("/", [ProductController::class, "index"])->name("admin.product.index");
            Route::get("/create", [ProductController::class, "create"])->name("admin.product.create");
            Route::post("/", [ProductController::class, "store"])->name("admin.product.store");
            Route::get("/{id}", [ProductController::class, "edit"])->name("admin.product.edit");
            Route::put("/{id}", [ProductController::class, "update"])->name("admin.product.update");
            Route::delete("/{id}", [ProductController::class, "destroy"])->name("admin.product.destroy");
            Route::post("/price-form/{id}", [ProductController::class, "price_form"])->name("admin.product.price-form");
        });

        Route::prefix("transaction")->group(function () {
            Route::get("/", [TransactionController::class, "index"])->name("admin.transaction.index");
            Route::delete("/{id}", [TransactionController::class, "destroy"])->name("admin.transaction.destroy");

            Route::put("/{id}/confirm", [TransactionController::class, "confirm"])->name("admin.transaction.confirm");
            Route::put("/{id}/delivery", [TransactionController::class, "delivery"])->name("admin.transaction.delivery");
        });
    });
});
