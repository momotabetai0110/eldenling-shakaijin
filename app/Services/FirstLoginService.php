<?php

namespace App\Services;

use App\Models\User;

class FirstLoginService
{
    public function createUser(string $userName): string
    {
        $user = User::createFirstLoginUser($userName);

        return $user->user_uuid;
    }
}
