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
        Schema::create('stock_in_details', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('shortcode');
            $table->string('item');
            $table->string('quantity');
            $table->double('cost');
            $table->double('total');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('stock_in_id');
            $table->foreign('stock_in_id')->references('id')->on('stock_in_headers')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_in_details');
    }
};
