<?php

namespace App\Domain\Interfaces;

use App\Application\DTOs\UserDTO;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Password;

interface UserServiceInterface
{
    public function findUserById(int $id): ?User;
    public function logout(User $user): void;

    public function registerUser(UserDTO $userDTO, Password $password): void;
    public function getUserByEmail(string $email): ?User;

    public function createDefaultUser(): User;

    public function updateUser(User $user): void;

}
