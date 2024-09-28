<?php

namespace App\Application\Services;

use App\Application\DTOs\UserDTO;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Interfaces\UserServiceInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use Laravel\Passport\TokenRepository;

class UserService implements UserServiceInterface
{
    /**
     * Create a new class instance.
     */
    private UserRepositoryInterface $userRepository;
    private TokenRepository $tokenRepository;

    public function __construct(UserRepositoryInterface $userRepository, TokenRepository $tokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function findUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function logout(User $user): void
    {
        foreach ($user->tokens as $token) {
            $this->tokenRepository->revokeAccessToken($token->id);
        }
    }

    public function registerUser(UserDTO $userDTO, Password $password): void
    {
        $userData = [
            'name' => $userDTO->getName(),
            'email' => $userDTO->getEmail(),
            'password' => $password->getValue()
        ];

        $user = User::createFromArray($userData);

        $this->userRepository->save($user);
    }

    public function getUserByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function createDefaultUser(): User
    {
        return User::createEmpty();
    }

    public function updateUser(User $user): void
    {
        $this->userRepository->save($user);
    }
}
