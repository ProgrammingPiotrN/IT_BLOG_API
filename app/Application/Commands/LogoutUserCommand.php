<?php

namespace App\Application\Commands;

class LogoutUserCommand
{
    /**
     * Create a new class instance.
     */

     private int $userId;

     public function __construct(int $userId)
     {
         $this->userId = $userId;
     }

     public function getUserId(): int
     {
         return $this->userId;
     }
}
