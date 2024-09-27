<?php

namespace App\Domain\Interfaces;

use App\Domain\Models\User;

interface UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function save(User $user): void;

    public function findByEmail(string $email): ?User;
}
