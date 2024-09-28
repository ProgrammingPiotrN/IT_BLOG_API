<?php

namespace App\Application\Commands\Post;

use App\Application\DTOs\Post\PostDTO;

class CreatePostCommand
{
    /**
     * Create a new class instance.
     */
    public PostDTO $postDTO;

    public function __construct(PostDTO $postDTO)
    {
        $this->$postDTO = $postDTO;
    }
}
