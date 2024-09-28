<?php

namespace App\Domain\Exceptions;

use Exception;

class CannotCreateUserException extends Exception
{
    public static function withEmptyEmail(): self
    {
        return new self('Email cannot be empty.');
    }

    public static function withEmailAlreadyExists(string $email): self
    {
        return new self("The email '{$email}' is already taken.");
    }

    public static function withInvalidEmailFormat(string $email): self
    {
        return new self("The email '{$email}' is not a valid format.");
    }
}
