<?php

namespace App\Application\Handlers;

use App\Application\Commands\GetUsersCommand;
use App\Application\Services\UserService;
use App\Domain\Interfaces\UserServiceInterface;
use App\Domain\Models\User;
use InvalidArgumentException;

class GetUsersHandler
{
    /**
     * Create a new class instance.
     */

    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function handle(GetUsersCommand $getUsersCommand): ?User
    {
        // Email validation
        if (!$this->isValidEmail($getUsersCommand->email)) {
            throw new InvalidArgumentException('Invalid email address.');
        }

        // Retrieve user using UserService
        return $this->userService->getUserByEmail($getUsersCommand->email);
    }

    private function isValidEmail(string $email): bool
    {
        // Simple email validation
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}
