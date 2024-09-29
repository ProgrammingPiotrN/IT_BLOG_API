<?php

namespace App\Policies;

use App\Application\DTOs\Post\PostDTO;
use App\Domain\Models\Post;
use App\Domain\Models\User;

class PostPolicy
{
    public function view(?User $user, Post $post): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isModerator();
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->getAuthor->id;
    }

    public function comment(User $user, Post $post): bool
    {
        return $user->isModerator();
    }

    public function like(User $user, Post $post): bool
    {
        return $user->isModerator();
    }
}
