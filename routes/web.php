<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\VariantDetailController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get("/", [PageController::class, "home"])->name("home");
Route::get("/products", [PageController::class, "products"])->name("products");
Route::get("/product/{slug}", [PageController::class, "product"])->name("product");
Route::get("/categories", [PageController::class, "categories"])->name("categories");
Route::get("/category/{slug}", [PageController::class, "category"])->name("category");
Route::get("/about", [PageController::class, "about"])->name("about");
Route::get("/register-seller", [PageController::class, "register_seller"])->name("register-seller");

Route::prefix("simulate-payment")->group(function () {
    Route::get("/", [PageController::class, "simulate_payment"])->name("simulate_payment.index");
    Route::post("/", [PageController::class, "simulate_payment_store"])->name("simulate_payment.store");
});

Route::prefix("rajaongkir")->group(function () {
    Route::get("province", [RajaOngkirController::class, "province"]);
    Route::get("city/{province_id}", [RajaOngkirController::class, "city"]);
    Route::get("subdistrict/{city_id}", [RajaOngkirController::class, "subdistrict"]);
    Route::post("get-shipping-cost", [RajaOngkirController::class, "getShippingCost"]);
    Route::post("get-shipping-cost-shipment", [RajaOngkirController::class, "getShippingCostShipment"]);
});

Route::prefix("store")->group(function () {
    Route::get("/{slug}", [StoreController::class, "show"])->name("store.show");
    Route::post("store", [StoreController::class, "store"])->name("store.store");
    Route::get("success", [StoreController::class, "success"])->name("store.success");
});

Route::get("/search", [PageController::class, "search"])->name("search");

// JQUERY FETCH
Route::get("/get-stock/{productID}/{variant1ID}/{variant2ID}", [ProductController::class, "get_stock"])->name("product.get-stock");

Route::middleware("guest")->group(function () {
    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "login_post"])->name("login.post");
    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "register_post"])->name("register.post");
    Route::get("forgot-password", [AuthController::class, "forgot_password"])->name("forgot-password");
    Route::post("forgot-password", [AuthController::class, "forgot_password_post"])->name("forgot-password-post");
    Route::get("forgot-password-done", [AuthController::class, "forgot_password_done"])->name("forgot-password-done");
    Route::get("/reset-password/{token}", [AuthController::class, "reset_password"])->name("password.reset");
    Route::post("/reset-password", [AuthController::class, "reset_password_post"])->name("password.update");
    Route::get("/login/google", [AuthController::class, "redirectToGoogle"])->name("login.google");
    Route::get("/login/google/callback", [AuthController::class, "handleGoogleCallback"])->name("login.google.callback");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [AuthController::class, "logout"])->name("logout");

    Route::post("/product/{slug}/checkout", [PageController::class, "product_checkout_post"])->name("product.checkout.post");
    Route::get("/product/{slug}/checkout", [PageController::class, "product_checkout"])->name("product.checkout");
    Route::get("/cek-promo/{session_name}", [VoucherController::class, "show"])->name("voucher.show");
    Route::get("/delete-promo/{session_name}", [VoucherController::class, "cancel_promo"])->name("voucher.cancel");
    // Route::post("/product/{slug}/checkout", [PageController::class, "product_checkout"])->name("product.checkout");
    Route::get("/payment-waiting/{invoice}", [PageController::class, "payment_waiting"])->name("payment.waiting");
    Route::get("/payment-success/{invoice}", [PageController::class, "payment_success"])->name("payment.success");

    Route::prefix("address")->group(function () {
        Route::get("/", [AddressController::class, "index"])->name("address.index");
        Route::get("/create", [AddressController::class, "create"])->name("address.create");
        Route::post("/", [AddressController::class, "store"])->name("address.store");
        Route::get("/{id}", [AddressController::class, "edit"])->name("address.edit");
        Route::put("/{id}", [AddressController::class, "update"])->name("address.update");
        Route::put("/change/{id}", [AddressController::class, "change_address"])->name("address.change-address");
        Route::delete("/{id}", [AddressController::class, "destroy"])->name("address.destroy");
    });

    Route::prefix("transaction")->group(function () {
        Route::get("/", [PageController::class, "transaction"])->name("transaction");
        Route::get("/{id}", [TransactionController::class, "show"])->name("transaction.show");
        Route::post("/", [TransactionController::class, "store"])->name("transaction.store");
        Route::post("/shipment", [TransactionController::class, "transaction_from_shipment"])->name("transaction.shipment");
        Route::put("/{id}/{transaction_detail_id}/done", [TransactionController::class, "done"])->name("admin.transaction.done");
    });

    Route::prefix("cart")->group(function () {
        Route::get("/", [CartController::class, "index"])->name("cart");
        Route::post("/total", [CartController::class, "get_total"])->name("cart.total");
        Route::post("/", [CartController::class, "store"])->name("cart.store");
        Route::post("/shipment", [CartController::class, "shipment_post"])->name("cart.shipment.post");
        Route::get("/shipment", [CartController::class, "shipment"])->name("cart.shipment");
        Route::delete("/{id}", [CartController::class, "destroy"])->name("cart.destroy");
        Route::delete("/delete/all", [CartController::class, "destroy_all"])->name("cart.destroy.all");
    });

    Route::prefix("profile")->group(function () {
        Route::get("/", [PageController::class, "profile"])->name("profile");
        Route::get("/change-password", [PageController::class, "change_password"])->name("profile.change-password");
        Route::post("/change-password", [AuthController::class, "change_password_post"])->name("profile.change-password.post");
        Route::put("/", [PageController::class, "profile_update"])->name("profile.update");
    });

    Route::prefix("admin")->group(function () {
        Route::get("/dashboard", [PageController::class, "dashboard"])->name("admin.dashboard");

        Route::prefix("user")->group(function () {
            Route::get("/", [UserController::class, "index"])->name("admin.user.index");
        });

        Route::prefix("seller")->group(function () {
            Route::get("/", [StoreController::class, "index"])->name("admin.seller.index");
            Route::get("/{id}", [StoreController::class, "show_detail"])->name("admin.seller.show-detail");
            Route::put("/{id}/confirm", [StoreController::class, "confirm"])->name("admin.seller.confirm");
            Route::put("/{id}/deactive", [StoreController::class, "deactive"])->name("admin.seller.deactive");
            Route::put("/{id}/activate", [StoreController::class, "activate"])->name("admin.seller.deactive");
        });

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

        Route::prefix("voucher")->group(function () {
            Route::get("/", [VoucherController::class, "index"])->name("admin.voucher.index");
            Route::get("/create", [VoucherController::class, "create"])->name("admin.voucher.create");
            Route::post("/", [VoucherController::class, "store"])->name("admin.voucher.store");
            Route::get("/{id}", [VoucherController::class, "edit"])->name("admin.voucher.edit");
            Route::put("/{id}", [VoucherController::class, "update"])->name("admin.voucher.update");
            Route::delete("/{id}", [VoucherController::class, "destroy"])->name("admin.voucher.destroy");
            Route::put("/{id}/deactivate", [VoucherController::class, "deactivate"])->name("admin.voucher.deactivate");
            Route::put("/{id}/activate", [VoucherController::class, "activate"])->name("admin.voucher.activate");
        });

        Route::prefix("transaction")->group(function () {
            Route::get("/", [TransactionController::class, "index"])->name("admin.transaction.index");
            Route::delete("/{id}", [TransactionController::class, "destroy"])->name("admin.transaction.destroy");
            Route::put("/{id}/{transaction_detail_id}/confirm", [TransactionController::class, "confirm"])->name("admin.transaction.confirm");
            Route::put("/{id}/{transaction_detail_id}/delivery", [TransactionController::class, "delivery"])->name("admin.transaction.delivery");
        });

        Route::prefix("carousel")->group(function () {
            Route::get("/", [CarouselController::class, "index"])->name("admin.carousel.index");
            Route::put("/", [CarouselController::class, "update"])->name("admin.carousel.update");
            Route::delete("/{id}", [CarouselController::class, "destroy"])->name("admin.carousel.destroy");
        });
    });

    Route::prefix("seller")->group(function () {
        Route::get("dashboard", [PageController::class, "dashboard"])->name("seller.dashboard");

        Route::prefix("store")->group(function () {
            Route::get("/", [StoreController::class, "index"])->name("seller.store.index");
            Route::get("/create", [StoreController::class, "create"])->name("seller.store.create");
            Route::post("/", [StoreController::class, "store"])->name("seller.store.store");
            Route::get("/my-store", [StoreController::class, "edit"])->name("seller.store.edit");
            Route::put("/", [StoreController::class, "update"])->name("seller.store.update");
            Route::delete("/{id}", [StoreController::class, "destroy"])->name("seller.store.destroy");
        });

        Route::prefix("product")->group(function () {
            Route::get("/", [ProductController::class, "index"])->name("seller.product.index");
            Route::get("/create", [ProductController::class, "create"])->name("seller.product.create");
            Route::post("/", [ProductController::class, "store"])->name("seller.product.store");
            Route::get("/{id}", [ProductController::class, "edit"])->name("seller.product.edit");
            Route::put("/{id}", [ProductController::class, "update"])->name("seller.product.update");
            Route::delete("/{id}", [ProductController::class, "destroy"])->name("seller.product.destroy");
            Route::post("/price-form/{id}", [ProductController::class, "price_form"])->name("seller.product.price-form");
        });

        Route::prefix("variant")->group(function () {
            Route::get("/", [VariantController::class, "index"])->name("seller.variant.index");
            Route::get("/create", [VariantController::class, "create"])->name("seller.variant.create");
            Route::post("/", [VariantController::class, "store"])->name("seller.variant.store");
            Route::get("/show/{id}", [VariantController::class, "show"])->name("seller.variant.show");
            Route::get("/{id}", [VariantController::class, "edit"])->name("seller.variant.edit");
            Route::put("/{id}", [VariantController::class, "update"])->name("seller.variant.update");
            Route::delete("/{id}", [VariantController::class, "destroy"])->name("seller.variant.destroy");
        });
        Route::delete("/variant_detail/{id}", [VariantDetailController::class, "destroy"])->name("admin.variant-detail.destroy");

        Route::prefix("transaction")->group(function () {
            Route::get("/", [TransactionController::class, "index"])->name("seller.transaction.index");
            Route::get("/{id}", [TransactionController::class, "show"])->name("seller.transaction.show");
            Route::post("/", [TransactionController::class, "store"])->name("seller.transaction.store");
            Route::put("/{id}/done", [TransactionController::class, "done"])->name("seller.transaction.done");
        });

        Route::prefix("voucher")->group(function () {
            Route::get("/", [VoucherController::class, "index"])->name("seller.voucher.index");
            Route::get("/create", [VoucherController::class, "create"])->name("seller.voucher.create");
            Route::post("/", [VoucherController::class, "store"])->name("seller.voucher.store");
            Route::get("/{id}", [VoucherController::class, "edit"])->name("seller.voucher.edit");
            Route::put("/{id}", [VoucherController::class, "update"])->name("seller.voucher.update");
            Route::delete("/{id}", [VoucherController::class, "destroy"])->name("seller.voucher.destroy");
            Route::put("/{id}/deactivate", [VoucherController::class, "deactivate"])->name("seller.voucher.deactivate");
            Route::put("/{id}/activate", [VoucherController::class, "activate"])->name("seller.voucher.activate");
        });
    });

    Route::prefix("change-password")->group(function () {
        Route::get("/", [AuthController::class, "change_password_backend"])->name("backend.change-password");
        Route::put("/", [AuthController::class, "change_password_backend_post"])->name("backend.change-password-post");
    });
});
