<?php

namespace App\Domain\ValueObjects\Post;

class Content
{
    public function __construct(private string $content)
    {
        if (strlen($content) < 10) {
            throw new \InvalidArgumentException("Content must be at least 10 characters long.");
        }
    }

    public function getValue(): string
    {
        return $this->content;
    }
}
