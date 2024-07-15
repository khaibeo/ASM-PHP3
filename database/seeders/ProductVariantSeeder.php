<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $productIds = DB::table('products')->pluck('id')->toArray();
        $colorIds = DB::table('product_colors')->pluck('id')->toArray();
        $sizeIds = DB::table('product_sizes')->pluck('id')->toArray();

        //Tạo mỗi sản phẩm có 3 biến thể
        foreach ($productIds as $product) { 
            for ($i=0; $i < 3; $i++) { 
                DB::table('product_variants')->insert([
                    'product_id' => $product,
                    'size_id' => $faker->randomElement($sizeIds),
                    'color_id' => $faker->randomElement($colorIds),
                    'quantity' => $faker->numberBetween(1, 100),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
