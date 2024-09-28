<?php

namespace App\Application\Handlers\Post;

use App\Application\Commands\Post\CreatePostCommand;
use App\Domain\Interfaces\Post\PostServiceInterface;

class CreatePostHandler
{
    /**
     * Create a new class instance.
     */
    private PostServiceInterface $postServiceInterface;

    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }

    public function handle(CreatePostCommand $command)
    {
        $this->postServiceInterface->create($command->postDTO);
    }
}
