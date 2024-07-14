<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $orderIds = DB::table('orders')->pluck('id')->toArray();
        $productVariantIds = DB::table('product_variants')->pluck('id')->toArray();

        foreach ($orderIds as $orderId) {
            $itemCount = $faker->numberBetween(1, 3);

            for ($i = 0; $i < $itemCount; $i++) {
                $productVariantId = $faker->randomElement($productVariantIds);

                $regular_price = $faker->numberBetween(100000, 200000);
                $sale_price = $faker->optional(0.5)->numberBetween(50000, 99000);

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_variant_id' => $productVariantId,
                    'quantity' => $faker->numberBetween(1, 10),
                    'product_name' => $faker->words(3, true),
                    'product_sku' => $faker->unique()->ean8,
                    'product_sale_price' => $sale_price,
                    'product_regular_price' => $regular_price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
