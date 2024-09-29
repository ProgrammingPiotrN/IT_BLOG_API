<?php

namespace Tests\Unit;

use App\Application\DTOs\UserDTO;
use App\Application\Services\UserService;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use Laravel\Passport\TokenRepository;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
    private UserRepositoryInterface $userRepository;
    private TokenRepository $tokenRepository;
    private UserService $userService;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->tokenRepository = $this->createMock(TokenRepository::class);
        $this->userService = new UserService($this->userRepository, $this->tokenRepository);
    }

    public function testFindUserByIdReturnsUser()
    {
        $user = new User(/* inicjalizacja użytkownika, np. 'name' => 'Test User' */);
        $this->userRepository->expects($this->once())
            ->method('findById')
            ->with(1) // Upewnij się, że przekazujesz odpowiedni ID
            ->willReturn($user);

        $result = $this->userService->findUserById(1);

        $this->assertSame($user, $result);
    }

    public function testLogoutRevokesUserTokens()
    {
        $tokenMock = $this->createMock(\Laravel\Passport\Token::class);
        $tokenMock->id = 123;

        $user = new User(/* inicjalizacja użytkownika */);
        $user->tokens = [$tokenMock];

        $this->tokenRepository->expects($this->once())
            ->method('revokeAccessToken')
            ->with($tokenMock->id);

        $this->userService->logout($user);
    }

    public function testRegisterUserSavesUser()
    {
        $userDTO = new UserDTO('Test User', 'test@example.com');
        $password = new Password('securepassword');

        // Upewnij się, że metoda createFromArray jest dostępna w klasie User
        $user = User::createFromArray([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => $password->getValue(),
        ]);

        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($user);

        $this->userService->registerUser($userDTO, $password);
    }

    public function testGetUserByEmailReturnsUser()
    {
        $user = new User(/* inicjalizacja użytkownika */);
        $this->userRepository->expects($this->once())
            ->method('findByEmail')
            ->with('test@example.com')
            ->willReturn($user);

        $result = $this->userService->getUserByEmail('test@example.com');

        $this->assertSame($user, $result);
    }

    public function testCreateDefaultUser()
    {
        $userMock = $this->createMock(User::class);

        // Jeśli createEmpty jest statyczną metodą, musisz wywołać ją w odpowiedni sposób
        $user = User::createEmpty();

        $this->assertInstanceOf(User::class, $user);
    }

    public function testUpdateUserSavesUser()
    {
        $user = new User(/* inicjalizacja użytkownika */);

        $this->userRepository->expects($this->once())
            ->method('save')
            ->with($user);

        $this->userService->updateUser($user);
    }
}
