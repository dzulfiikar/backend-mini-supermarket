<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'user_id',
        'member_id',
        'voucher_id',
        'total_price'
    ];

    public function getRouteKeyName()
    {
        return 'transaction_id';
    }

    public function getTransactionCart(){
        return $this->hasMany(Cart::class, 'transaction_id', 'transaction_id');
    }
}
