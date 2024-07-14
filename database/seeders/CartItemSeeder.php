<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $cartIds = DB::table('carts')->pluck('id')->toArray();
        $productVariantIds = DB::table('product_variants')->pluck('id')->toArray();

        foreach ($cartIds as $cartId) {
            $itemCount = $faker->numberBetween(1, 5);

            for ($i = 0; $i < $itemCount; $i++) {
                DB::table('cart_items')->insert([
                    'cart_id' => $cartId,
                    'product_variant_id' => $faker->randomElement($productVariantIds),
                    'quantity' => $faker->numberBetween(1, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
