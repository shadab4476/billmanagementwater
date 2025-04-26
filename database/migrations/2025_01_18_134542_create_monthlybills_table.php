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
        Schema::create('monthlybills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("bill_number");
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('bill_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->date('due_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('payment_method')->default('cash');
            $table->enum('status', ["unpaid", "paid", "pending"])->default('unpaid'); //
            $table->string('total_amount');
            $table->string('paid_amount')->nullable();
            $table->string('note')->nullable();
            $table->foreign("shop_id")->references("id")->on("shops")->onDelete("cascade");
            $table->foreign("user_id")->references('id')->on("users")->onDelete("cascade");
            $table->foreign("bill_id")->references('id')->on("bills")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthlybills');
    }
};
