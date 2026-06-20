<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Seat extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'seats';

    protected $fillable = [
        'numero',
        'status',
        'cliente',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}