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
                "created_at" => now(),
                "inserted_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 2,
                "product_stock" => 20,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 3,
                "product_stock" => 30,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 4,
                "product_stock" => 50,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_id" => 5,
                "product_stock" => 100,
                "inserted_at" => now(),
                "created_at" => now(),
                "updated_at" => now()
            ],
        );
    }
}
