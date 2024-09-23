<?php

namespace App\Domain\Interfaces;

use App\Domain\Models\User;

interface UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function save(User $user): void;

    public function findAll(int $page = 1, int $limit = 10): array;

    public function findByEmail(string $email): ?User;
}
