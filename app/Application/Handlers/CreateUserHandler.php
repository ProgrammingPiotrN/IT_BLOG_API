<?php

namespace App\Application\Handlers;

use App\Application\Commands\CreateUserCommand;
use App\Application\DTOs\CreateUserDTO;
use App\Application\Services\UserService;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Infrastructure\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\Notification;

class CreateUserHandler
{
    /**
     * Create a new class instance.
     */
    private UserRepositoryInterface $userService;

    public function __construct(UserRepositoryInterface $userService)
    {
        $this->userService = $userService;
    }

    public function handle(CreateUserCommand $command): void
    {
        $userDTO = $command->userDTO;

        // Tworzenie użytkownika z użyciem DTO
        $user = new User($userDTO->getName(), new Email($userDTO->getEmail()), $command->password);

        // Użycie serwisu do zapisu użytkownika
        $this->userService->save($user);
    }
}
