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
        Schema::create('customer_item_redeems', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->text('description')->nullable();
            $table->string('point');
            $table->unsignedBigInteger('cust_id');
            $table->foreign('cust_id')->references('id')->on('customers');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_item_redeems');
    }
};
