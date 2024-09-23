<?php

namespace App\Providers;

use App\Application\Handlers\CreateUserHandler;
use App\Application\Handlers\GetUsersHandler;
use App\Application\Services\UserService;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\GetUsersUseCase;
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
        $this->app->singleton(UserRepository::class, function ($app) {
            // Zakładam, że masz połączenie z bazą danych jako PDO
            $dbConnection = new PDO('mysql:host=localhost;dbname=itblogapi', 'root', 'Student!@2024');
            return new UserRepository($dbConnection);
        });

        $this->app->singleton(GetUsersHandler::class, function ($app) {
            return new GetUsersHandler(new UserService($app->make(UserRepository::class)));
        });

        $this->app->singleton(CreateUserHandler::class, function ($app) {
            return new CreateUserHandler(new UserService($app->make(UserRepository::class)));
        });

        $this->app->singleton(GetUsersUseCase::class, function ($app) {
            return new GetUsersUseCase($app->make(GetUsersHandler::class));
        });

        $this->app->singleton(CreateUserUseCase::class, function ($app) {
            return new CreateUserUseCase($app->make(GetUsersHandler::class));
        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

