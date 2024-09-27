<?php

namespace App\Domain\ValueObjects;

class Password
{
    /**
     * Create a new class instance.
     */
    private string $password;

    public function __construct(string $password)
    {
        if (strlen($password) < 6) {
            throw new \InvalidArgumentException("Password must be at least 6 characters long");
        }
        $this->password = $password;
    }

    public function getValue(): string
    {
        return $this->password;
    }
}
