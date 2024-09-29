<?php

namespace App\Application\Commands\Post;

use App\Application\DTOs\Post\CommentDTO;
use App\Domain\Models\Post;
use App\Domain\Models\User;

class CommentOnPostCommand
{
    /**
     * Create a new class instance.
     */
    public Post $post;
    public User $user;
    public CommentDTO $commentDTO;

    public function __construct(Post $post, User $user, CommentDTO $commentDTO)
    {
        $this->post = $post;
        $this->user = $user;
        $this->commentDTO = $commentDTO;
    }
}
