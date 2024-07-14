<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $userIds = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $userId = $faker->randomElement($userIds);

            $totalProductPrice = $faker->numberBetween(50000, 1000000);
            $discountAmount = $faker->numberBetween(0, 10000);
            $totalAmount = $totalProductPrice - $discountAmount;

            DB::table('orders')->insert([
                'user_id' => $userId,
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'note' => $faker->optional(0.3)->sentence,
                'payment_method' => $faker->randomElement([0, 1]),
                'order_status' => $faker->randomElement(['unpaid', 'pending', 'processing', 'shipped', 'delivered', 'cancelled']),
                'total_product_price' => $totalProductPrice,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
