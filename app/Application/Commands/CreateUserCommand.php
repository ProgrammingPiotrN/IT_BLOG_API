<?php

namespace App\Application\Commands;

use App\Application\DTOs\UserDTO;

class CreateUserCommand
{
    /**
     * Create a new class instance.
     */
    public UserDTO $userDTO;

    public function __construct(UserDTO $userDTO)
    {
        $this->userDTO = $userDTO;
    }
}
