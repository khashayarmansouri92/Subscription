<?php

namespace App\Services\Users;

use App\Dtos\User\LoginDto;
use Illuminate\Database\Eloquent\Model;

interface UserServiceInterface
{
    public function login(LoginDto $attr): ?array;
}
