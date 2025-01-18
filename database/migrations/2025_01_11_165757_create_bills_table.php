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
        Schema::create('bills', function (Blueprint $table) {
            $table->id(); // like bill number 
            // i want to create bills management system only cash and please help me to create the column
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('user_id');
            $table->string('bill_date');
            $table->string('bill_due_date');
            $table->boolean('bill_status')->default('1'); // 0 = paid and 1 = unpaid
            // $table->string('bill_discount'); this will be show in frontend 
            // $table->string('bill_tax');this will be show in frontend 
            // $table->string('bill_net_total');this will be show in frontend 
            $table->string('bill_payment_method')->default('cash');
            $table->string('bill_payment_date');
            $table->string('paided_amount');
            $table->string('bill_note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
            $table->string('bill_total');
