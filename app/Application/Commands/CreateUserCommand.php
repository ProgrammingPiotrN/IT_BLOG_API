<?php

namespace App\Application\Commands;

use App\Application\DTOs\CreateUserDTO;

class CreateUserCommand
{
    /**
     * Create a new class instance.
     */
    public CreateUserDTO $userDTO;
    public string $password;

    public function __construct(CreateUserDTO $userDTO, string $password)
    {
        $this->userDTO = $userDTO;
        $this->password = $password;
    }
}
