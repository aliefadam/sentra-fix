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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string("invoice");
            $table->foreignId("user_id");
            $table->foreignId("store_id");
            $table->double("sub_total_product");
            $table->text("shipping_address");
            $table->double("shipping_cost");
            $table->double("shipping_code")->nullable();
            $table->string("shipping_service");
            $table->string("payment");
            $table->double("total");
            $table->string("status");
            $table->string("due_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
