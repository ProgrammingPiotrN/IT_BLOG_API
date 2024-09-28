<?php

namespace App\Application\Commands\Post;

use App\Application\DTOs\Post\CommentDTO;

class CommentOnPostCommand
{
    /**
     * Create a new class instance.
     */
    public int $postId;

    public CommentDTO $commentDTO;

    public function __construct(int $postId, CommentDTO $commentDTO)
    {
        $this->postId = $postId;
        $this->commentDTO = $commentDTO;
    }
}
