<?php

namespace App\Services\Users;

use App\Models\Game;
use App\Models\User;
use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    use InteractsWithUser;

    /**
     * @param string $username
     * @param bool $main
     * @return Model
     * @throws \Exception
     */
    public function firstOrCreate(string $username, bool $main): Model
    {
        return $this->UserRepository()->firstOrCreate([
            'username' => $username,
            'main_user' => $main,
        ]);
    }

    /**
     * @param User $user
     * @param Game $game
     * @return bool
     * @throws \Exception
     */
    public function attach(User $user, Game $game): mixed
    {
        return $this->UserRepository()->attach($user, $game);
    }
}
