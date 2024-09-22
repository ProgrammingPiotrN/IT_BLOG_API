<?php

namespace App\Domain\Repositories;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): User
    {
        $userModel = new User();
        $userModel->name = $user->name;
        $userModel->email = $user->email;
        $userModel->password = $user->password;
        $userModel->save();

        return $user;
    }
}
