<?php

namespace App\Application\UseCases;

use App\Application\Commands\CreateUserCommand;
use App\Application\Handlers\CreateUserHandler;

class CreateUserUseCase
{
    /**
     * Create a new class instance.
     */
    private CreateUserHandler $createUserHandler;

    public function __construct(CreateUserHandler $createUserHandler)
    {
        $this->createUserHandler = $createUserHandler;
    }

    public function execute(CreateUserCommand $command): void
    {
        $this->createUserHandler->handle($command);
    }
}
