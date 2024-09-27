<?php

namespace App\Application\UseCases;

use App\Application\Commands\LogoutUserCommand;
use App\Application\Handlers\LogoutUserHandler;

class LogoutUserUseCase
{
    /**
     * Create a new class instance.
     */
    private LogoutUserHandler $handler;

    public function __construct(LogoutUserHandler $handler)
    {
        $this->handler = $handler;
    }

    public function execute(LogoutUserCommand $command): void
    {
        $this->handler->handle($command);
    }
}
