<?php

namespace App\Application\Handlers;

use App\Application\Commands\ResetTokenCommand;
use App\Domain\Interfaces\UserRepositoryInterface;

class ResetTokenHandler
{
    /**
     * Create a new class instance.
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(ResetTokenCommand $command): void
    {
        // Logika resetowania tokenu
    }
}
