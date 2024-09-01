<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use RoleEnum;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Model
     */
    public function getAdmin(): Model
    {
        return User::role(RoleEnum::ADMIN->value)->first();
    }
}
