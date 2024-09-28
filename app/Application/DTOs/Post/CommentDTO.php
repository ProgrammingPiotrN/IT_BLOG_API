<?php

namespace App\Application\DTOs\Post;

class CommentDTO
{
    /**
     * Create a new class instance.
     */
    public readonly string $comment;

    public function __construct(string $comment)
    {
        $this->comment = $comment;
    }
}
