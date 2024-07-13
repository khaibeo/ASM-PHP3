<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i <10 ; $i++){
        DB::table('product_galleries')->insert([
            'product_id' => rand(1,30),
            'image' => 'link ' . $i,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
      }
    }
}
