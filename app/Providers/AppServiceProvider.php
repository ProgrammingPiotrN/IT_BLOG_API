<?php

namespace App\Providers;

use App\Application\Handlers\CreateUserHandler;
use App\Application\Handlers\GetUsersHandler;
use App\Application\Handlers\LogoutUserHandler;
use App\Application\Handlers\Post\CommentOnPostHandler;
use App\Application\Handlers\Post\CreatePostHandler;
use App\Application\Handlers\Post\DeletePostHandler;
use App\Application\Handlers\Post\LikePostHandler;
use App\Application\Handlers\ResetTokenHandler;
use App\Application\Services\Post\PostService;
use App\Application\Services\UserService;
use App\Application\UseCases\CreateUserUseCase;
use App\Application\UseCases\GetUsersUseCase;
use App\Application\UseCases\LogoutUserUseCase;
use App\Application\UseCases\Post\CommentOnPostUseCase;
use App\Application\UseCases\Post\CreatePostUseCase;
use App\Application\UseCases\Post\DeletePostUseCase;
use App\Application\UseCases\Post\LikePostUseCase;
use App\Application\UseCases\ResetTokenUseCase;
use App\Domain\Interfaces\Post\PostRepositoryInterface;
use App\Domain\Interfaces\Post\PostServiceInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Interfaces\UserServiceInterface;
use App\Domain\Models\Post;
use App\Domain\Models\User;
use App\Domain\Repositories\Post\PostRepository;
use App\Domain\Repositories\UserRepository;
use App\Policies\PostPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use PDO;

class AppServiceProvider extends AuthServiceProvider
{
    /**
     * Register any application services.
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Post::class => PostPolicy::class,
    ];

    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);

        $this->app->bind(CreateUserHandler::class, CreateUserHandler::class);
        $this->app->bind(GetUsersHandler::class, GetUsersHandler::class);
        $this->app->bind(LogoutUserHandler::class, LogoutUserHandler::class);
        $this->app->bind(ResetTokenHandler::class, ResetTokenHandler::class);

        $this->app->bind(CommentOnPostHandler::class, CommentOnPostHandler::class);
        $this->app->bind(CreatePostHandler::class, CreatePostHandler::class);
        $this->app->bind(DeletePostHandler::class, DeletePostHandler::class);
        $this->app->bind(LikePostHandler::class, LikePostHandler::class);

        $this->app->bind(CreateUserUseCase::class, CreateUserUseCase::class);
        $this->app->bind(GetUsersUseCase::class, GetUsersUseCase::class);
        $this->app->bind(LogoutUserUseCase::class, LogoutUserUseCase::class);
        $this->app->bind(ResetTokenUseCase::class, ResetTokenUseCase::class);

        $this->app->bind(CommentOnPostUseCase::class, CommentOnPostUseCase::class);
        $this->app->bind(CreatePostUseCase::class, CreatePostUseCase::class);
        $this->app->bind(DeletePostUseCase::class, DeletePostUseCase::class);
        $this->app->bind(LikePostUseCase::class, LikePostUseCase::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

