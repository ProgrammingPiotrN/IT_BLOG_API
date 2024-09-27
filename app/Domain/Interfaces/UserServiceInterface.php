<?php

namespace App\Domain\Interfaces;

use App\Application\DTOs\UserDTO;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Password;

interface UserServiceInterface
{
    public function registerUser(UserDTO $userDTO, Password $password): void;
    public function getUserByEmail(string $email): ?User;
}
