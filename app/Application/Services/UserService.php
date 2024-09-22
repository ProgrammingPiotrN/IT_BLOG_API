<?php

namespace App\Application\Services;

use App\Application\DTOs\UserDTO;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function createUser(UserDTO $userDTO): User
    {
        $user = User::createFromArray([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => $userDTO->password,
        ]);

        return $this->repository->save($user);
    }
}
