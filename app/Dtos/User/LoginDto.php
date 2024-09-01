<?php

namespace App\Dtos\User;

class LoginDto
{
    public string $email;
    public string $password;

    public function __construct(string $username, string $password)
    {
        $this->email = $username;
        $this->password = $password;
    }

    public static function fromRequest($request): self
    {
        return new self(
            $request->input('username'),
            $request->input('password')
        );
    }
}
