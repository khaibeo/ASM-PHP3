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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->unsignedInteger('min_order_value')->nullable()->default(0);
            $table->unsignedInteger('max_order_value')->nullable()->default(null);
            $table->tinyInteger('display_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropColumn('min_order_value');
            $table->dropColumn('max_order_value');
            $table->dropColumn('display_status');
        });
    }
};
