<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    
    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'product_id',
        'product_stock'
    ];

    public function getRouteKeyName()
    {
        return 'inventory_id';
    }

}
