<?php

namespace App\Domain\Interfaces\Post;

use App\Application\DTOs\Post\CommentDTO;
use App\Application\DTOs\Post\PostDTO;

interface PostServiceInterface
{
    public function create(PostDTO $postDTO): void;

    public function like(int $postId): void;

    public function comment(int $postId, CommentDTO $commentDTO): void;

    public function delete(int $postId): void;
}
