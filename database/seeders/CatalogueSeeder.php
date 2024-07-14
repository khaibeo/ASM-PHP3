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

        $parentIds = []; // Mảng lưu trữ id của danh mục cha

        // Tạo 3 các danh mục gốc
        for ($i = 1; $i <= 3; $i++) {
            $id = DB::table('catalogues')->insertGetId([
                'name' => $faker->word,
                'image' => 'https://drake.vn/image/catalog/H%C3%ACnh%20content/gia%CC%80y%20Converse%20da%20bo%CC%81ng/giay-converse-da-bong-5.jpg',
                'parent_id' => null,
                'is_active' => $faker->boolean($chanceOfGettingTrue = 80),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Thêm id của danh mục gốc vào mảng parentIds
            $parentIds[] = $id;
        }

        // Tạo các danh mục con cho mỗi danh mục gốc (mỗi danh mục gốc có 3 danh mục con )
        foreach ($parentIds as $parentId) {
            for ($i = 1; $i <= 3; $i++) {
                DB::table('catalogues')->insert([
                    'name' => $faker->word,
                    'image' => 'https://drake.vn/image/catalog/H%C3%ACnh%20content/gia%CC%80y%20Converse%20da%20bo%CC%81ng/giay-converse-da-bong-5.jpg',
                    'parent_id' => $parentId,
                    'is_active' => $faker->boolean($chanceOfGettingTrue = 80),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
