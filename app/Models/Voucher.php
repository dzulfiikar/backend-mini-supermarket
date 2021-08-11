<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'voucher_id';

    protected $fillable = [
        'voucher_name',
        'voucher_value',
        'voucher_point'
    ];

    public function getRouteKeyName()
    {
        return 'voucher_id';
    }
}
