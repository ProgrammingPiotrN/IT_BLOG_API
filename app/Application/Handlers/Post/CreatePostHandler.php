<?php

namespace App\Application\Handlers\Post;

use App\Application\Commands\Post\CreatePostCommand;
use App\Domain\Interfaces\Post\PostServiceInterface;
use App\Domain\Models\Post;
use App\Domain\Models\User;

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

    public function handle(CreatePostCommand $command, User $user): Post
    {
        return $this->postServiceInterface->create($user, $command->postDTO);
    }
}
