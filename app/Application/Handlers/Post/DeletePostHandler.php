<?php

namespace App\Application\Handlers\Post;

use App\Domain\Interfaces\Post\PostServiceInterface;

class DeletePostHandler
{
    /**
     * Create a new class instance.
     */
    private PostServiceInterface $postServiceInterface;

    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }
}
