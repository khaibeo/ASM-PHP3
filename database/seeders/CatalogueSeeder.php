<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CatalogueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i=0;$i<=10;$i++){
            DB::table('catalogues')->insert(
                [
                'name' => $faker->word,
                'image' => 'https://drake.vn/image/catalog/H%C3%ACnh%20content/gia%CC%80y%20Converse%20da%20bo%CC%81ng/giay-converse-da-bong-5.jpg',
                'parent_id' => $faker->numberBetween($min = 1, $max = 10),
                'is_active' => $faker->boolean($chanceOfGettingTrue = 50),
                'created_at' => now(),
                'updated_at' => now(),
                ]
            );
        }
    }
}
