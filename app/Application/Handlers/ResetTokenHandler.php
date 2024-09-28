<?php

namespace App\Application\Handlers;

use App\Application\Commands\ResetTokenCommand;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Interfaces\UserServiceInterface;
use InvalidArgumentException;

class ResetTokenHandler
{
    /**
     * Create a new class instance.
     */
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function handle(ResetTokenCommand $command): void
    {
        // Validate that the user ID is provided
        if (!$command->getUserId()) {
            throw new InvalidArgumentException("User ID must be provided.");
        }

        // Retrieve the user by ID using UserService
        $user = $this->userService->findUserById($command->getUserId());

        // Validate user existence
        if (!$user) {
            throw new \Exception("User not found.");
        }

        // Reset user's tokens (assuming resetTokens is a method in User model)
        $user->resetTokens();

        // Save the modified user after resetting tokens
        $this->userService->updateUser($user); // Assuming updateUser method exists in UserService
    }
}
