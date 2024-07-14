<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;




class SliderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            DB::table('sliders_detail')->insert([
                'slider_id' => $faker->numberBetween(1, 10),
                'image_url' => $faker->imageUrl(),
                'link_url' => $faker->imageUrl(),
                'position' => $faker->numberBetween(1, 10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
