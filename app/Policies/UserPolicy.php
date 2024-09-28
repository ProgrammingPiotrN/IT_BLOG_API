<?php

namespace App\Policies;

use App\Domain\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function view(User $authUser, User $user)
    {
        return $authUser->getEmail()->getValue() === $user->getEmail()->getValue();
    }
}
