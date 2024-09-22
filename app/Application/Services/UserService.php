<?php

namespace App\Application\Services;

use App\Application\DTOs\UserDTO;
use App\Domain\Exceptions\UserCreationException;
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
        // Walidacja dla pustego imienia
        if (empty($userDTO->name)) {
            throw UserCreationException::withEmptyName();
        }

        // Walidacja dla zbyt krótkiego imienia
        if (strlen($userDTO->name) < 3) {
            throw UserCreationException::withNameTooShort(3);
        }

        // Utworzenie użytkownika
        $user = User::createFromArray([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => bcrypt($userDTO->password),
        ]);

        // Zapis użytkownika w repozytorium
        return $this->repository->save($user);
    }
}
