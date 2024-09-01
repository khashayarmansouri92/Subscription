<?php

namespace App\Repositories\Users;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    public function getAdmin(): Model;
}
