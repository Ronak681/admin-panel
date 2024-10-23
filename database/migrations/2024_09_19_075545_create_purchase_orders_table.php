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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('supplier_name');
            $table->date('delivery_date');
            $table->date('create_date');
            $table->string('serial_number');
            $table->string('remarks')->nullable();
            $table->string('order_number')->nullable();
            $table->boolean('is_deleted');

            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
