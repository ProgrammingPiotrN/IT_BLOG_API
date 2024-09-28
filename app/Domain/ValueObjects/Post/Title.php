<?php

namespace App\Domain\ValueObjects\Post;

class Title
{
    public function __construct(private string $title)
    {
        if (strlen($title) < 5) {
            throw new \InvalidArgumentException("Title must be at least 5 characters long.");
        }
    }

    public function getValue(): string
    {
        return $this->title;
    }
}
