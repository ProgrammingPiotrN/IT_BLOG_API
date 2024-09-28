<?php

namespace App\Domain\Interfaces\Post;

use App\Domain\Models\Post;

interface PostRepositoryInterface
{
    public function save(Post $post): void;
    public function findById(int $id): ?Post;
    public function delete(Post $post): void;
}
