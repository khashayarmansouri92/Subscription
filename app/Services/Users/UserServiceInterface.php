<?php

namespace App\Services\Users;

use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    public function firstOrCreate(string $username, bool $main): Model;
    public function attach(User $user, Game $game): mixed;
}
