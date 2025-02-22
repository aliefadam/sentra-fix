<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transaction_id");
            $table->foreignId("store_id");
            $table->string("product_name");
            $table->string("product_image");
            $table->string("product_price");
            $table->string("qty");
            $table->string("variant");
            $table->double("shipping_cost");
            $table->double("shipping_code")->nullable();
            $table->string("shipping_service");
            $table->double("sub_total");
            $table->double("total");
            $table->text("notes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
