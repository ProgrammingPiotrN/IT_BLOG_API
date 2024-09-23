<?php

namespace App\Domain\ValueObjects;

class Email
{
    /**
     * Create a new class instance.
     */
    private string $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address.");
        }
        $this->email = $email;
    }

    public function getValue(): string
    {
        return $this->email;
    }
}
