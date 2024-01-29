<?php

namespace App\Repositories\Users;

use App\Models\Game;
use App\Models\User;

interface UserRepositoryInterface
{
    public function attach(User $user ,Game $game): mixed;
}
