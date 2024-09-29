<?php

namespace App\Domain\Interfaces\Post;

use App\Application\DTOs\Post\CommentDTO;
use App\Application\DTOs\Post\PostDTO;
use App\Domain\Models\Post;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Post\Comment;
use App\Domain\ValueObjects\Post\Content;

interface PostServiceInterface
{
    public function create(User $user, PostDTO $postDTO): Post;

    public function like(Post $post, User $user): void;

    public function comment(Post $post, User $user, CommentDTO $commentDTO): void;

    public function delete(Post $post): void;
}
