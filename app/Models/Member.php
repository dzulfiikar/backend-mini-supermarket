<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $table_name = 'members';
    protected $primaryKey = 'member_id';

    protected $fillable = [
        'member_name',
        'member_address',
        'member_phone',
        'member_point'
    ];
}
