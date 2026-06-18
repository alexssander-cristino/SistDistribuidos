<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeadMessage extends Model
{
    protected $fillable = [
        'seat',
        'cliente',
        'error'
    ];
}