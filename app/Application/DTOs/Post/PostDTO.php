<?php

namespace App\Application\DTOs\Post;

use App\Domain\Models\User;

class PostDTO
{
    /**
     * Create a new class instance.
     */

    public readonly string $title;
    public readonly string $content;
    public User $author;
    public string $createdAt;
    public string $updatedAt;
    public function __construct(string $title, string $content, User $author,
    string $createAt, string $updatedAt)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createAt;
        $this->updatedAt = $updatedAt;
    }
}
