<?php

namespace App\Application\UseCases;

use App\Application\Commands\CreateUserCommand;
use App\Application\Handlers\CreateUserHandler;
use App\Domain\Models\User;

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
        return $this->createUserHandler->handle($command);
    }
}
