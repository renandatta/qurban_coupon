<?php

use App\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $no = $i;
            $no = strlen($i) == 1 ? '00' . $i : $no;
            $no = strlen($i) == 2 ? '0' . $i : $no;
            Coupon::create([
                'period_id' => 1,
                'no_coupon' => $no,
                'name' => 'Kupon nomor ' . $no
            ]);
        }

    }
}
