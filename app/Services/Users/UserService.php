<?php

namespace App\Services\Users;

use App\Dtos\User\LoginDto;
use App\Traits\InteractsWithUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    use InteractsWithUser;

    /**
     * @param LoginDto $attr
     * @return array|null
     */
    public function login(LoginDto $attr): ?array
    {
        $credentials = [
            'email' => $attr->email,
            'password' => $attr->password,
        ];

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $token = $user->createToken('access_token')->plainTextToken;

            return [
                'token_type' => 'Bearer',
                'roles' => Auth::user()->getRoleNames(),
                'access_token' => $token,
                'user_id' => $user->id,
                'first_name' => $user?->first_name,
                'last_name' => $user?->last_name,
            ];
        }
        return null;
    }
}
