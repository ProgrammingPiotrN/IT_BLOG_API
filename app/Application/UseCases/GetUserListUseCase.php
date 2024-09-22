<?php

namespace App\Application\UseCases;

use App\Domain\Interfaces\UserRepositoryInterface;

class GetUserListUseCase
{
    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
