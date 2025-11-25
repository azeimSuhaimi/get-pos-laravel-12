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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->string('shortcode');
            $table->string('name');
            $table->string('quantity');
            $table->double('price');
            $table->double('cost');
            $table->integer('discount')->default(0);
            $table->string('description')->nullable();
            $table->string('category');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('inv_id');
            $table->foreign('inv_id')->references('id')->on('invoices');
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');;
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
