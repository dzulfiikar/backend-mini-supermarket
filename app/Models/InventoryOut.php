<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryOut extends Model
{
    use HasFactory;

    protected $table = 'inventory_out';
    protected $primaryKey = 'inventory_out_id';

    protected $fillable = [
        'inventory_id',
        'qty',
        'transaction_id'
    ];
}
