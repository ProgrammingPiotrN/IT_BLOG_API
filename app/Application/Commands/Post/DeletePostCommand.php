<?php

namespace App\Application\Commands\Post;

use App\Domain\Models\Post;

class DeletePostCommand
{
    /**
     * Create a new class instance.
     */
    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
