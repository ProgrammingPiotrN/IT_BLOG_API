<?php

namespace App\Application\Services;

use App\Application\DTOs\UserDTO;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Interfaces\UserServiceInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;

class UserService implements UserServiceInterface
{
    /**
     * Create a new class instance.
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(UserDTO $userDTO, Password $password): void
    {
        // Logika rejestracji użytkownika
        $email = new Email($userDTO->getEmail());
        $user = new User($userDTO->getName(), $email, $password);
        $this->userRepository->save($user);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }
}
