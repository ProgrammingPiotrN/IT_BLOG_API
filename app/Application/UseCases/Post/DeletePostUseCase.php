<?php

namespace App\Application\UseCases\Post;

use App\Application\Commands\Post\DeletePostCommand;
use App\Application\Handlers\Post\DeletePostHandler;

class DeletePostUseCase
{
    /**
     * Create a new class instance.
     */
    private DeletePostHandler $deletePostHandler;

    public function __construct(DeletePostHandler $deletePostHandler)
    {
        $this->deletePostHandler = $deletePostHandler;
    }

    public function execute(DeletePostCommand $command): void
    {
        $this->deletePostHandler->handle($command);
    }
}
