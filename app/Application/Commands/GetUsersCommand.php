<?php

namespace App\Application\Commands;

class GetUsersCommand
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public ?int $page = 1,
        public ?int $limit = 10
    ){}
}
