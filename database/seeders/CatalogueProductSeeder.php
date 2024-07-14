<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CatalogueProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Assuming you have at least 10 catalogues and 10 products
        $productIds = DB::table('products')->pluck('id')->toArray();
        $catalogueIds = DB::table('catalogues')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('catalogue_product')->insert([
                'product_id' => $faker->randomElement($productIds),
                'catalogue_id' => $faker->randomElement($catalogueIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
