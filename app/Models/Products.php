<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $table = "products";

    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_name',
        'product_price'
    ];

    public function getRouteKeyName()
    {
        return 'product_id';
    }

    public function inventory(){
        return $this->hasMany(Inventory::class, 'product_id', 'product_id');
    }
}
