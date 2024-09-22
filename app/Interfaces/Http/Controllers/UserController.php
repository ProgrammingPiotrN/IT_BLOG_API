<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\DTOs\UserDTO;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\GetUserListUseCase;
use App\Domain\Exceptions\UserCreationException;
use App\Http\Resources\Interface\Http\Resources\UserResource;

use App\Infrastructure\Notifications\UserCreatedNotification;
use App\Interfaces\Http\Requests\CreateUserRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    protected CreateUserUseCase $createUserUseCase;
    protected GetUserListUseCase $getUserListUseCase;

    public function __construct(CreateUserUseCase $createUserUseCase, GetUserListUseCase $getUserListUseCase)
    {
        $this->createUserUseCase = $createUserUseCase;
        $this->getUserListUseCase = $getUserListUseCase;
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        try {
            $userDTO = UserDTO::fromArray($request->validated());
            $user = $this->createUserUseCase->execute($userDTO);

            // Wysyłanie powiadomienia
            Notification::send($user, new UserCreatedNotification($user->name));

            return response()->json([
                'message' => 'User created successfully!',
            ], 201);
        } catch (UserCreationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An unexpected error occurred',
            ], 500);
        }
    }

    public function index(): JsonResponse
    {
        $users = $this->getUserListUseCase->execute();
        return UserResource::collection(collect($users))->response();
    }
}
