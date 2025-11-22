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
        Schema::create('customer_purchase_details', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->string('shortcode');
            $table->string('item');
            $table->text('description')->nullable();
            $table->integer('quantity');
            $table->double('cost');
            $table->double('price');
            $table->integer('discount')->default(0);
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
        Schema::dropIfExists('customer_purchase_details');
    }
};
