<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpiredSubscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'count',
        'recorded_at'
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
    ];
}
