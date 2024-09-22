<?php

namespace App\Application\UseCases;

use App\Application\DTOs\UserDTO;
use App\Application\Services\UserService;

class CreateUserUseCase
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function execute(UserDTO $userDTO)
    {
        return $this->userService->createUser($userDTO);
    }
}
