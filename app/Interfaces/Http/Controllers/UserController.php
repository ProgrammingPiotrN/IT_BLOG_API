<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Commands\GetUsersCommand;
use App\Application\DTOs\CreateUserDTO;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\GetUsersUseCase;
use App\Domain\Models\User;
use App\Interfaces\Http\Requests\GetUsersRequest;
use App\Http\Resources\Interface\Http\Resources\UserResource;
use App\Interfaces\Http\Requests\CreateUserRequest;


class UserController extends Controller
{
    private CreateUserUseCase $createUserUseCase;
    private GetUsersUseCase $getUsersUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase, GetUsersUseCase $getUsersUseCase)
    {
        $this->createUserUseCase = $createUserUseCase;
    }

    public function store(CreateUserRequest $request)
    {
        $userDTO = new CreateUserDTO($request->name, $request->email, $request->password);
        $this->createUserUseCase->handle($userDTO);
        return response()->json(['message' => 'Użytkownik został utworzony!'], 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function index(GetUsersRequest $request)
    {
        $command = new GetUsersCommand(
            page: $request->query('page', 1),
            limit: $request->query('limit', 10)
        );
        $users = $this->getUsersUseCase->execute($command);

        return UserResource::collection($users);
    }
}
