<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Commands\CreateUserCommand;
use App\Application\DTOs\UserDTO;
use App\Application\Handlers\CreateUserHandler;
use App\Interfaces\Http\Requests\CreateUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController
{
    protected CreateUserHandler $handler;

    public function __construct(CreateUserHandler $handler) {
        $this->handler = $handler;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request): JsonResponse
    {
        $userDTO = UserDTO::fromArray($request->validated());
        $command = new CreateUserCommand($userDTO);
        $this->handler->handle($command);

        return response()->json([
            'message' => 'User created successfully!',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
