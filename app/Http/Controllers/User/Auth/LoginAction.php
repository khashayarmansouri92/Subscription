<?php

namespace App\Http\Controllers\User\Auth;

use App\Dtos\User\LoginDto;
use App\Http\Requests\User\LoginRequest;
use App\Http\Resources\ApiResponse\ResourcesTrait;
use App\Traits\InteractsWithUser;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class LoginAction
{
    use InteractsWithUser, ResourcesTrait;

    public function __invoke(LoginRequest $request)
    {
        $loginDTO = LoginDTO::fromRequest($request);

        $data = $this->UserService()->login($loginDTO);

        if (!$data){
            return $this->error(HttpFoundationResponse::HTTP_UNAUTHORIZED, trans('messages.error'));
        }

        return $this->success($data, trans('messages.welcome'), HttpFoundationResponse::HTTP_OK);
    }
}


