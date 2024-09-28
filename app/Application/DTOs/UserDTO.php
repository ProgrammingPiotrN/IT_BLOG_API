<?php

namespace App\Application\DTOs;

use App\Domain\ValueObjects\Email;

class UserDTO
{
    /**
     * Create a new class instance.
     */
    private string $name;
    private Email $email;

    public function __construct(string $name, Email $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
