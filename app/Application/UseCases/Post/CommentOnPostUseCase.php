<?php

namespace App\Application\UseCases\Post;

use App\Application\Commands\Post\CommentOnPostCommand;
use App\Application\Handlers\Post\CommentOnPostHandler;

class CommentOnPostUseCase
{
    /**
     * Create a new class instance.
     */
    private CommentOnPostHandler $commentOnPostHandler;

    public function __construct(CommentOnPostHandler $commentOnPostHandler)
    {
        $this->commentOnPostHandler = $commentOnPostHandler;
    }

    public function execute(CommentOnPostCommand $command): void
    {
        $this->commentOnPostHandler->handle($command);
    }
}
