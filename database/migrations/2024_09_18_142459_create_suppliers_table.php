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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supllier_category_id')->nullable()->index();
            $table->string('pic_name');
            $table->string('supplier_name');
            $table->timestamps();
        });

        Schema::create('category_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_category_name');
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};