<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class DeadMessage extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'dead_messages';

    protected $fillable = [
        'seat',
        'cliente',
        'error',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}