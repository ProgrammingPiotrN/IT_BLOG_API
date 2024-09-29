<?php

namespace App\Application\UseCases\Post;

use App\Application\Commands\Post\CreatePostCommand;
use App\Application\Handlers\Post\CreatePostHandler;
use App\Domain\Models\User;

class CreatePostUseCase
{
    /**
     * Create a new class instance.
     */
    private CreatePostHandler $handlerCreatePostHandler;

    public function __construct(CreatePostHandler $handlerCreatePostHandler)
    {
        $this->handlerCreatePostHandler = $handlerCreatePostHandler;
    }

    public function execute(CreatePostCommand $command, User $user): void
    {
        $this->handlerCreatePostHandler->handle($command, $user);
    }
}
