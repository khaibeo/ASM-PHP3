<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;


class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void

    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('sliders')->insert([
                'title' => $faker->sentence(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
