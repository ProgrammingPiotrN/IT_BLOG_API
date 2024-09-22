<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateUserCommand;
use App\Application\Services\UserService;

class CreateUserHandler
{
    /**
     * Create a new class instance.
     */
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function handle(CreateUserCommand $command)
    {
        $this->userService->createUser($command->userDTO);
    }
}
