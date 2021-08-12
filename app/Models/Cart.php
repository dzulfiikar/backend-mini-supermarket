<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primayKey = 'cart_id';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price_per_qty'
    ];

    public function getRouteKeyName()
    {
        return 'cart_id';
    }
}
