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
            $table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('cascade');
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
    // id	int	ID	
// catalogue_id	int	ID danh mục	
// name	varchar	Tên	
// slug	varchar	Slug	
// sku	varchar	Mã sản phẩm	
// thumbnail	varchar	Ảnh đại diện	
// sale_price	double	Giá sale	null
// regular_price	double	Giá thường	
// short_description	varchar	Mô tả ngắn	null
// description	text	Mô tả	null
// views	int	Lượt xem	default 0
// is_active	boolen	Trạng thái	default 1
// is_featured	boolen	Đánh dấu nổi bật	default 0
// created_at	timestamp	Thời gian tạo	
// updated_at	timestamp	Thời gian cập nhật	
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        
    }
};
