<?php

namespace App\Application\UseCases\Post;

use App\Application\Commands\Post\LikePostCommand;
use App\Application\Handlers\Post\LikePostHandler;

class LikePostUseCase
{
    /**
     * Create a new class instance.
     */
    private LikePostHandler $likePostHandler;

    public function __construct(LikePostHandler $likePostHandler)
    {
        $this->likePostHandler = $likePostHandler;
    }

    public function execute(LikePostCommand $command): void
    {
        $this->likePostHandler->handle($command);
    }
}
