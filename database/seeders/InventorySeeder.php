<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('inventory')->insert($this->inventoryDataset());
    }

    private function inventoryDataset(){
        return array(
            [
                "product_id" => 1,
                "product_stock" => 12,
                "remaining_stock" => 12,
                "product_price" => 10000,
                "created_at" => now(),
                "inserted_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 2,
                "product_stock" => 20,
                "remaining_stock" => 20,
                "product_price" => 20000,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 3,
                "product_stock" => 30,
                "remaining_stock" => 30,
                "product_price" => 30000,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 4,
                "product_stock" => 50,
                "remaining_stock" => 50,
                "product_stock" => 50,
                "product_price" => 40000,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 5,
                "product_stock" => 100,
                "remaining_stock" => 100,
                "product_price" => 50000,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
        );
    }
}
