<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $now = Carbon::now();

        // giả sử tạo ra 10 mã giảm giá, với 2 loại 0 và 1 với value tương ứng, có một số mã giảm giá đã hết hạn vào 1 ngày trước, những mã còn hạn
        // sẽ hết hạn sau 7 ngày

        for ($i = 0; $i < 10; $i++) {
            // Loại giảm giá có 2 giá trị trị:nếu là 0 thì giảm giá trực tiếp, 1 là giảm theo phần trăm
            $discountType = $faker->randomElement([0, 1]);
            $discountValue = $discountType == 0
                ? $faker->randomElement([10000, 20000, 30000]) // Giảm giá trực tiếp ( ngẫu nhiên một trong 3 giá trị)
                : $faker->randomElement([10, 20, 30]); // Giảm giá theo %

            // Thời gian bắt đầu của voucher nằm trong khoảng 2 tuần trước, set thời gian là 0h00
            $validFrom = $faker->dateTimeBetween('-2 week', '-1 week')->setTime(0, 0, 0);

            // Tạo thời gian kết thúc cho voucher, thời gian kết thúc phải lớn hơn bắt đầu
            if ($faker->boolean(30)) { // tạo 30% voucher đã hết hạn
                $validUntil = $now->copy()->subDay()->setTime(0, 0, 0); // Voucher hết hạn 1 ngày trước
            } else {
                $validUntil = $now->copy()->addDays(7)->setTime(0, 0, 0); // Voucher còn hạn trong khoảng 7 ngày                
            }

            DB::table('voucher')->insert([
                'code' => Str::upper(Str::random(8)),
                'discount_type' => $discountType,
                'discount_value' => $discountValue,
                'quantity' => $faker->numberBetween(10, 100),
                'valid_from' => $validFrom,
                'valid_until' => $validUntil,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
