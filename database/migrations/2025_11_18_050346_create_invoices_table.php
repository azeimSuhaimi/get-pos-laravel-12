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
        Schema::create('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->unique();
            $table->string('cust_id');
            $table->double('subtotal');
            $table->double('tax');
            $table->double('total');
            $table->boolean('status');
            $table->string('name')->nullable();
            $table->integer('daily_unique_number')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
