<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;

class DatabaseUserNotification extends DatabaseNotification
{
    protected $table = 'notifications';

}
