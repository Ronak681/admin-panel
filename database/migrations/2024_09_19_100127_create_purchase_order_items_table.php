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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id'); 
            $table->string('style_name');
            $table->string('item_name');
            $table->string('hsn_code');
            $table->string('color_name');
            $table->string('size_name');
            $table->integer('quantity'); 
            $table->string('unit_name');
            $table->decimal('rate', 10, 2); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
