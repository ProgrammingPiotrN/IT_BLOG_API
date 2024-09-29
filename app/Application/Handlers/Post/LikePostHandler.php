<?php

namespace App\Application\Handlers\Post;

use App\Application\Commands\Post\LikePostCommand;
use App\Domain\Interfaces\Post\PostRepositoryInterface;
use App\Domain\Interfaces\Post\PostServiceInterface;
use App\Domain\Models\User;
use Illuminate\Support\Facades\Auth;

class LikePostHandler
{
    /**
     * Create a new class instance.
     */
    private PostServiceInterface $postServiceInterface;
    private PostRepositoryInterface $postRepositoryInterface;

    public function __construct(PostServiceInterface $postServiceInterface, PostRepositoryInterface $postRepositoryInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
        $this->postRepositoryInterface = $postRepositoryInterface;
    }

    public function handle(LikePostCommand $command): void
    {
        // Znajdź post na podstawie postId
        $post = $this->postRepositoryInterface->findById($command->postId);

        // Uzyskaj zalogowanego użytkownika
        $user = Auth::user();

        // Sprawdź, czy użytkownik jest zalogowany
        if (!$user instanceof User) {
            throw new \Exception('User must be logged in to like a post.');
        }

        // Wywołaj metodę like na serwisie
        $this->postServiceInterface->like($post, $user);
    }
}
