<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductVariantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'product_id' => rand(1,30),
                'size_id'=> rand(1,30),
                'color_id'=> rand(1,30),
                'quantity'=> rand(1,60),
                'created_at'=> now(),
                'updated_at'=> now(),
            ];
        }
        DB::table('product_variants')->insert($data);
    }
}
