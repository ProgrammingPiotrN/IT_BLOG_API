<?php

namespace App\Application\Commands;

class GetUsersCommand
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
