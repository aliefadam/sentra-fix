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
            $table->text("shipping_address");
            $table->string("payment");
            $table->double("total");
            $table->string("payment_status");
            $table->string("due_date");
            $table->string("promo_code")->nullable();
            $table->double("discount")->nullable();
            $table->double("total_after_discount")->nullable();
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
