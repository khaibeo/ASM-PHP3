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

        // có 10 slider
        // Mỗi slider sẽ có 3 hình ảnh được xếp thứ tự từ 1 -> 3
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                DB::table('sliders_detail')->insert([
                    'slider_id' => $i,
                    'image_url' => $faker->imageUrl(),
                    'link_url' => $faker->url(),
                    'position' => $j,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
