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
        Schema::create('suspends', function (Blueprint $table) {
            $table->id();
            $table->string('bill_id');
            $table->double('total');
            $table->unsignedBigInteger('cust_id')->nullable();
            $table->foreign('cust_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspends');
    }
};
