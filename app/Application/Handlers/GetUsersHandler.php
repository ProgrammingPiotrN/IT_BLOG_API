<?php

namespace App\Application\Handlers;

use App\Application\Commands\GetUsersCommand;
use App\Application\DTOs\ProfileUserDTO;
use App\Application\Services\UserService;
use App\Domain\Interfaces\UserRepositoryInterface;

class GetUsersHandler
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function handle(GetUsersCommand $command): array
    {
        $users = $this->userRepository->findAll($command->page, $command->limit);

        return array_map(function($user) {
            return new ProfileUserDTO(
                name: $user->getName(),
                email: $user->getEmail()->getValue()
            );
        }, $users);
    }
}
