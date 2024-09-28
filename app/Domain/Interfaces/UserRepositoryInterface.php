<?php

namespace App\Domain\Interfaces;

use App\Domain\Models\User;

interface UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function save(User $user): void;

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function delete(int $id): void;

    // Pobierz listę użytkowników z paginacją
    public function findAll(int $page = 1, int $limit = 10): array;

}
