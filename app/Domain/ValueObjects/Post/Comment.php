<?php

namespace App\Domain\ValueObjects\Post;

class Comment
{
    public function __construct(private string $comment)
    {
        if (strlen($comment) < 3) {
            throw new \InvalidArgumentException("Comment must be at least 3 characters long.");
        }
    }

    public function getValue(): string
    {
        return $this->comment;
    }
}
