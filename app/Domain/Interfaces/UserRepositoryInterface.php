<?php

namespace App\Domain\Interfaces;

use App\Domain\Models\User;

interface UserRepositoryInterface
{
    public function save(User $user): User;
    public function getAll(): array;

}
