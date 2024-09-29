<?php

namespace App\Application\Handlers\Post;

use App\Application\Commands\Post\CommentOnPostCommand;
use App\Domain\Interfaces\Post\PostServiceInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use Illuminate\Support\Facades\Auth;

class CommentOnPostHandler
{
    /**
     * Create a new class instance.
     */
    private PostServiceInterface $postServiceInterface;

    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }

    public function handle(CommentOnPostCommand $command): void
    {
        $authUser = Auth::user();
        if (!$authUser) {
            throw new \Exception('User must be logged in to comment on a post.');
        }

        $user = new User(
            $authUser->name,
            new Email($authUser->email),
            new Password($authUser->password)
        );

        $this->postServiceInterface->comment($command->post, $user, $command->commentDTO);
    }
}
