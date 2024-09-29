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
    string $createdAt, string $updatedAt)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
