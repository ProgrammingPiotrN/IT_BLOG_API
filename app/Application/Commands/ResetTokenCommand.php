<?php

namespace App\Application\Commands;

class ResetTokenCommand
{
    /**
     * Create a new class instance.
     */

    public string $email;
    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
