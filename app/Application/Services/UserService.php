<?php

namespace App\Application\Services;

use App\Application\DTOs\CreateUserDTO;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Create a new class instance.
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(CreateUserDTO $userDTO): User
    {
        $hashed = Hash::make($userDTO->password);

        $user = User::createFromArray([
            'name' => $userDTO->name,
            'email' => $userDTO->email,
            'password' => $hashed,
        ]);
        $this->userRepository->save($user);
        return $user;
    }

    public function getAllUsers(int $page, int $limit): array
    {
        return $this->userRepository->findAll($page, $limit);
    }
}
