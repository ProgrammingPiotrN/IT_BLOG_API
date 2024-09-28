<?php

namespace App\Application\Handlers;

use App\Application\Commands\LogoutUserCommand;
use App\Domain\Interfaces\UserServiceInterface;
use InvalidArgumentException;

class LogoutUserHandler
{
    /**
     * Create a new class instance.
     */
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function handle(LogoutUserCommand $command): void
    {
        // Validate that the user ID is provided
        if (!$command->getUserId()) {
            throw new InvalidArgumentException("User ID must be provided.");
        }

        // Retrieve the user by ID
        $user = $this->userService->findUserById($command->getUserId());

        // Validate user existence
        if (!$user) {
            throw new \Exception("User not found.");
        }

        // Invalidate the user's tokens
        $this->userService->logout($user);
    }
}
