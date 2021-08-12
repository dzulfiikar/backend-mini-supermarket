<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('vouchers')->insert($this->voucherDataset());
    }

    private function voucherDataset(){
        return array(
            [
                'voucher_name' => 'Kupon Diskon 10%',
                'voucher_discount' => 0.1,
                'voucher_value' => 6000,
                'voucher_point' => 30,
                'voucher_type' => 'discount',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_name' => 'Kupon Diskon 20%',
                'voucher_discount' => 0.2,
                'voucher_value' => 15000,
                'voucher_point' => 40,
                'voucher_type' => 'discount',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_name' => 'Potongan Harga 50.000',
                'voucher_discount' => null,
                'voucher_value' => 50000,
                'voucher_point' => 80,
                'voucher_type' => 'fixed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'voucher_name' => 'Potongan Harga 100.000',
                'voucher_discount' => null,
                'voucher_value' => 100000,
                'voucher_point' => 100,
                'voucher_type' => 'fixed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        );
    }
}
