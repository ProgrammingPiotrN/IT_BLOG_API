<?php

namespace App\Application\Commands;

use App\Application\DTOs\UserDTO;
use App\Domain\ValueObjects\Password;

class CreateUserCommand
{
    /**
     * Create a new class instance.
     */
    public UserDTO $userDTO;
    public Password $password;

    public function __construct(UserDTO $userDTO, Password $password)
    {
        $this->userDTO = $userDTO;
        $this->password = $password;
    }
}
