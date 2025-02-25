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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("available_for");
            $table->string("code");
            $table->string("unit")->nullable();
            $table->double("nominal")->nullable();
            $table->double("minimal_transaction")->nullable();
            $table->integer("maximal_used")->nullable();
            $table->integer("used")->default(0);
            $table->boolean("active")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
