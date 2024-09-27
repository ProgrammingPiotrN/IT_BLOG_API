<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Commands\CreateUserCommand;
use App\Application\Commands\GetUsersCommand;
use App\Application\Commands\LogoutUserCommand;
use App\Application\Commands\ResetTokenCommand;
use App\Application\DTOs\CreateUserDTO;
use App\Application\DTOs\UserDTO;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\GetUsersUseCase;
use App\Application\UseCases\LogoutUserUseCase;
use App\Application\UseCases\ResetTokenUseCase;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Password;
use App\Http\Resources\Interface\Http\Resources\UserResource;
use App\Interfaces\Http\Requests\CreateUserRequest;
use App\Interfaces\Http\Requests\GetUsersRequest;
use App\Interfaces\Http\Requests\LogoutUsersRequest;
use App\Interfaces\Http\Requests\ResetTokenRequest;


class UserController extends Controller
{
    private CreateUserUseCase $createUserUseCase;
    private GetUsersUseCase $getUsersUseCase;

    private LogoutUserUseCase $logoutUsersUseCase;
    private ResetTokenUseCase $resetTokenUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase, GetUsersUseCase $getUsersUseCase,
     LogoutUserUseCase $logoutUsersUseCase, ResetTokenUseCase $resetTokenUseCase)
    {
        $this->createUserUseCase = $createUserUseCase;
        $this->getUsersUseCase = $getUsersUseCase;
        $this->logoutUsersUseCase = $logoutUsersUseCase;
        $this->resetTokenUseCase = $resetTokenUseCase;
    }

    public function store(CreateUserRequest $request)
    {
        $userDTO = new UserDTO(
            name: $request->input('name'),
            email: $request->input('email')
        );

        $command = new CreateUserCommand(
            userDTO: $userDTO,
            password: new Password($request->input('password'))
        );

        $this->createUserUseCase->execute($command);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function show(GetUsersRequest $request)
    {
        $command = new GetUsersCommand($request->input('email'));
        $user = $this->getUsersUseCase->execute($command);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(new UserResource($user), 200);
    }

    public function logout(LogoutUsersRequest $request)
    {
        $command = new LogoutUserCommand($request->input('email'));
        $this->logoutUsersUseCase->execute($command);

        return response()->json(['message' => 'User logged out successfully'], 200);
    }

    public function resetToken(ResetTokenRequest $request)
    {
        $command = new ResetTokenCommand($request->input('email'));
        $this->resetTokenUseCase->execute($command);

        return response()->json(['message' => 'Token reset successfully'], 200);
    }
}
