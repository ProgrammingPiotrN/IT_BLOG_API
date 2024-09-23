<?php

namespace App\Application\UseCases;

use App\Application\Commands\GetUsersCommand;
use App\Application\Handlers\GetUsersHandler;

class GetUsersUseCase
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private GetUsersHandler $getUsersHandler
    ) {}

    public function execute(GetUsersCommand $command): array
    {
        return $this->getUsersHandler->handle($command);
    }
}
