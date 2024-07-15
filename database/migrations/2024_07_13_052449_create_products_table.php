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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalogue_id');
            $table->foreign('catalogue_id')->references('id')->on('catalogues');
            $table->string('name');
            $table->string('slug');
            $table->string('sku');
            $table->string('thumbnail');
            $table->double('sale_price')->nullable();
            $table->double('regular_price');
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        
    }
};
