<?php

namespace App\Domain\Exceptions;
use App\Domain\Models\User;
use Exception;

class UserCreationException extends Exception
{
    public static function createNew(User $user, string $content):self
    {
        return new self("Error creating user: {$user->name} - {$content}");
    }

    public static function withEmptyName(): self
    {
        return new self("User creation failed: Name is empty.");
    }

    public static function withNameTooShort(int $min): self
    {
        return new self("User creation failed: Name is too short. It should be at least {$min} characters long.");
    }
}
