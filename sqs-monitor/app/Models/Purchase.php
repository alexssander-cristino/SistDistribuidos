<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Purchase extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'purchases';

    protected $fillable = [
        'seat',
        'cliente',
        'status',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}