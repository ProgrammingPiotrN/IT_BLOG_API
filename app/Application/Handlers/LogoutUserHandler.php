<?php

namespace App\Application\Handlers;

use App\Application\Commands\LogoutUserCommand;
use App\Domain\Interfaces\UserServiceInterface;

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
        $user = $this->userService->findUserById($command->getUserId());

        if (!$user) {
            throw new \Exception("User not found");
        }

        // Invalidate user's tokens
        $this->userService->logout($user);
    }
}
