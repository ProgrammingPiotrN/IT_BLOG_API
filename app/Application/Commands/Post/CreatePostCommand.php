<?php

namespace App\Application\Commands\Post;

use App\Application\DTOs\Post\PostDTO;
use App\Domain\Models\User;

class CreatePostCommand
{
    /**
     * Create a new class instance.
     */
    public PostDTO $postDTO;
    public User $user;

    public function __construct(PostDTO $postDTO, User $user)
    {
        $this->$postDTO = $postDTO;
        $this->user = $user;
    }
}
