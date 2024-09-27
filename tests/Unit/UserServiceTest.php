<?php

namespace Tests\Unit;

use App\Application\DTOs\UserDTO;
use App\Application\Services\UserService;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private $userRepositoryMock;
    private $userService;

    protected function setUp(): void
    {
        // Mockowanie UserRepositoryInterface
        $this->userRepositoryMock = $this->createMock(UserRepositoryInterface::class);

        // Inicjalizacja UserService z mockiem repozytorium
        $this->userService = new UserService($this->userRepositoryMock);
    }

    public function testRegisterUser(): void
    {
        // Ustawienie danych testowych
        $userDTO = new UserDTO('John Doe', 'john@example.com');
        $password = new Password('secret123');
        $email = new Email($userDTO->getEmail());
        $user = new User('John Doe', $email, $password);

        // Upewniamy się, że metoda `save` repozytorium zostanie wywołana raz z odpowiednim użytkownikiem
        $this->userRepositoryMock->expects($this->once())
            ->method('save')
            ->with($this->equalTo($user));

        // Wykonanie metody registerUser
        $this->userService->registerUser($userDTO, $password);
    }
}
