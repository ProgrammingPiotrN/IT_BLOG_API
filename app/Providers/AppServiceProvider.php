<?php

namespace App\Providers;

use App\Application\Handlers\CreateUserHandler;
use App\Application\Handlers\GetUsersHandler;
use App\Application\Handlers\LogoutUserHandler;
use App\Application\Handlers\ResetTokenHandler;
use App\Application\Services\UserService;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\GetUsersUseCase;
use App\Application\UseCases\LogoutUserUseCase;
use App\Application\UseCases\ResetTokenUseCase;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        $this->app->bind(CreateUserHandler::class, CreateUserHandler::class);
        $this->app->bind(GetUsersHandler::class, GetUsersHandler::class);
        $this->app->bind(LogoutUserHandler::class, LogoutUserHandler::class);
        $this->app->bind(ResetTokenHandler::class, ResetTokenHandler::class);

        $this->app->bind(CreateUserUseCase::class, CreateUserUseCase::class);
        $this->app->bind(GetUsersUseCase::class, GetUsersUseCase::class);
        $this->app->bind(LogoutUserUseCase::class, LogoutUserUseCase::class);
        $this->app->bind(ResetTokenUseCase::class, ResetTokenUseCase::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

