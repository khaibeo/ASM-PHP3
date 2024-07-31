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
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
//     id	int	ID	
// name	varchar	Tên	
// image	varchar	Ảnh đại diện	
// parent_id	varchar	danh mục cha	null
// is_active	boolen	Trạng thái	defaut true
// created_at	timestamp	Thời gian tạo	
// updated_at	timestamp	Thời gian cập nhật	


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogues');
    }
};
