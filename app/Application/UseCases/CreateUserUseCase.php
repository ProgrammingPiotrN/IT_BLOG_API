<?php

namespace App\Application\UseCases;

use App\Application\Commands\CreateUserCommand;
use App\Application\DTOs\CreateUserDTO;
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

    public function handle(CreateUserDTO $userDTO): void
    {
        $command = new CreateUserCommand($userDTO->name, $userDTO->email, $userDTO->password);
        $this->createUserHandler->handle($command);
    }
}
