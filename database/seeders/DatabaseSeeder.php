<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    
    public function run(): void
    {
        DB::beginTransaction();

        try {
            $this->call([
                UserSeeder::class,
                CatalogueSeeder::class,
                ProductSeeder::class,
                ProductGallerieSeeder::class,
                OrderSeeder::class,
                OrderItemSeeder::class,
                CartSeeder::class,
                CartItemSeeder::class,
                SliderSeeder::class,
                SliderDetailSeeder::class,
                VoucherSeeder::class
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
