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
        Schema::create('quick_order_details', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('shortcode');
            $table->string('name');
            $table->string('quantity');
            $table->double('price');
            $table->double('cost');
            $table->integer('discount')->default(0);
            $table->string('description')->nullable();
            $table->string('category');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('quick_orders_id');
            $table->foreign('quick_orders_id')->references('id')->on('quick_orders');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_order_details');
    }
};
