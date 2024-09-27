<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateUserCommand;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;

class CreateUserHandler
{
    /**
     * Create a new class instance.
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(CreateUserCommand $createUserCommand): void
    {
        $userDTO = $createUserCommand->userDTO;
        $email = new Email($userDTO->getEmail());
        $user = new User($userDTO->getName(), $email, $createUserCommand->password);
        $this->userRepository->save($user);
    }
}
