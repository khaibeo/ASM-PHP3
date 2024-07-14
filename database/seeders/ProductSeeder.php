<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'catalogue_id' => $faker->numberBetween(1, 10),
                'name' => $faker->name,
                'slug' => $faker->slug,
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'thumbnail' => 'https://drake.vn/image/catalog/H%C3%ACnh%20content/gia%CC%80y%20Converse%20da%20bo%CC%81ng/giay-converse-da-bong-5.jpg',
                'sale_price' => $faker->optional()->randomFloat(2, 10, 100),
                'regular_price' => $faker->randomFloat(2, 10, 100),
                'sort_description' => $faker->optional()->sentence,
                'description' => $faker->optional()->paragraph,
                'views' => 0,
                'is_active' => $faker->boolean(90),
                'is_featured' => $faker->boolean(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
