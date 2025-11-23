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
        Schema::create('stock_in_headers', function (Blueprint $table) {
            $table->id();
            $table->string('grn_no');
            $table->string('date_receive');
            $table->string('do_number');
            $table->string('supplier');
            $table->string('receive_by');
            $table->string('remark');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_in_headers');
    }
};
