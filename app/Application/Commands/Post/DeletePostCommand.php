<?php

namespace App\Application\Commands\Post;

class DeletePostCommand
{
    /**
     * Create a new class instance.
     */
    public int $postId;

    public function __construct(int $postId)
    {
        $this->postId = $postId;
    }
}
