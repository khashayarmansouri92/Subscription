<?php

namespace App\Repositories\Users;
use App\Models\Game;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param User $user
     * @param Game $game
     * @return void
     */
    public function attach(User $user ,Game $game): mixed
    {
        return $user->games()->attach($game);
    }
}
