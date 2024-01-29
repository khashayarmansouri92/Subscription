<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
