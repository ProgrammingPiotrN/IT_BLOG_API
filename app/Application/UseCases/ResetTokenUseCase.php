<?php

namespace App\Application\UseCases;

use App\Application\Commands\ResetTokenCommand;
use App\Application\Handlers\ResetTokenHandler;

class ResetTokenUseCase
{
    /**
     * Create a new class instance.
     */
    private ResetTokenHandler $handler;

    public function __construct(ResetTokenHandler $handler)
    {
        $this->handler = $handler;
    }

    public function execute(ResetTokenCommand $command): void
    {
        $this->handler->handle($command);
    }
}
