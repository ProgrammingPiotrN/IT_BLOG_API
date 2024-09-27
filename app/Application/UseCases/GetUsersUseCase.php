<?php

namespace App\Application\UseCases;

use App\Application\Commands\GetUsersCommand;
use App\Application\Handlers\GetUsersHandler;
use App\Domain\Models\User;

class GetUsersUseCase
{
    /**
     * Create a new class instance.
     */
    private GetUsersHandler $handler;

    public function __construct(GetUsersHandler $handler)
    {
        $this->handler = $handler;
    }

    public function execute(GetUsersCommand $command): ?User
    {
        return $this->handler->handle($command);
    }
}
