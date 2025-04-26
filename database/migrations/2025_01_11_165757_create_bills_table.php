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
            $table->string('date');
            $table->integer('quantity');
            $table->integer('rate');
            $table->string('note')->nullable();
            $table->timestamps();
            $table->foreign("shop_id")->references("id")->on("shops")->onDelete("cascade");
            $table->foreign("user_id")->references('id')->on("users")->onDelete("cascade");
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
