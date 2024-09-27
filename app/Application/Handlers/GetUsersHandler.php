<?php

namespace App\Application\Handlers;

use App\Application\Commands\GetUsersCommand;
use App\Application\DTOs\ProfileUserDTO;
use App\Application\Services\UserService;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;

class GetUsersHandler
{
    /**
     * Create a new class instance.
     */

     private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUsersCommand $getUsersCommand): ?User
    {
        return $this->userRepository->findByEmail($getUsersCommand->email);
    }
}
