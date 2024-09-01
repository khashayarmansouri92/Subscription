<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function apps(): HasMany
    {
        return $this->hasMany(App::class);
    }
}
