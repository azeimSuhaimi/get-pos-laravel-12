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
        Schema::create('quick_orders', function (Blueprint $table) {
            $table->id();
            $table->string('barcode');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email');
            $table->double('subtotal');
            $table->double('tax');
            $table->double('total');
            $table->integer('daily_unique_number')->default(0);
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_orders');
    }
};
