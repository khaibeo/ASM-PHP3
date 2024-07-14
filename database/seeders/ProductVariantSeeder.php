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

        // Assuming you have at least 10 products, 10 sizes, and 10 colors
        $productIds = DB::table('products')->pluck('id')->toArray();
        $colorIds = DB::table('product_colors')->pluck('id')->toArray();
        $sizeIds = DB::table('product_sizes')->pluck('id')->toArray();

        // Check if we have enough data to seed
        if (empty($productIds) || empty($colorIds) || empty($sizeIds)) {
            $this->command->info('Not enough data to seed product variants.');
            return;
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('product_variants')->insert([
                'product_id' => $faker->randomElement($productIds),
                'size_id' => $faker->randomElement($sizeIds),
                'color_id' => $faker->randomElement($colorIds),
                'quantity' => $faker->numberBetween(1, 100), // Ensure quantity is not null
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
