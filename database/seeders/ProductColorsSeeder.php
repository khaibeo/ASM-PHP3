<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          for ($i = 1; $i <= 10; $i++) {
            DB::table('product_colors')->insert([
                'name' => 'Color ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
          }
    }
}
