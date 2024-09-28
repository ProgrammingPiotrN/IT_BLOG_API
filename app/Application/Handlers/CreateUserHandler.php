<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateUserCommand;
use App\Domain\Interfaces\UserServiceInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;

class CreateUserHandler
{
    /**
     * Create a new class instance.
     */
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function handle(CreateUserCommand $createUserCommand): void
{
    // Prosta walidacja
    if (empty($createUserCommand->userDTO->getName()) || empty($createUserCommand->userDTO->getEmail())) {
        throw new \InvalidArgumentException('Name and email are required.');
    }

    // Użycie UserService do rejestracji użytkownika
    $this->userService->registerUser($createUserCommand->userDTO, $createUserCommand->password);
}
}
