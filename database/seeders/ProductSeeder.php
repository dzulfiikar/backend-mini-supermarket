<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return DB::table('products')->insert($this->productDataset());
    }
    

    private function productDataset(){
        return array(
            [
                "product_name" => "Beras Mentik",
                "product_stock" => "12",
                "product_price" => 12317,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_name" => "Beras Jagung",
                "product_stock" => "20",
                "product_price" => 9250,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_name" => "Susu kental manis INDOMILK",
                "product_stock" => "30",
                "product_price" => 10417,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_name" => "Air Mineral (Aqua Galon)",
                "product_stock" => "50",
                "product_price" => 37900,
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "product_name" => "Mie Instan ( Indomie goreng )",
                "product_stock" => "100",
                "product_price" => 2500,
                "created_at" => now(),
                "updated_at" => now()
            ],
        );
    }
    
}
