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
        Schema::create('table_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('phone_number'); 
            $table->string('country'); 
            $table->string('state'); 
            $table->string('city'); 
            $table->string('pin_code'); 
            $table->string('gst_number')->nullable(); 
            $table->string('pan_number')->nullable(); 
            $table->boolean('is_active')->default(true); 
            $table->boolean('is_deleted')->default(false); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_supplier');
    }
};
