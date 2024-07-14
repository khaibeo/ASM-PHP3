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
        Schema::create('sliders_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->string('image_url');
            $table->string('link_url');
            $table->integer('position');
            $table->timestamps();
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders_detail');
    }
};
