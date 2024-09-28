<?php

namespace App\Application\Services\Post;

use App\Application\DTOs\Post\CommentDTO;
use App\Application\DTOs\Post\PostDTO;
use App\Domain\Interfaces\Post\PostRepositoryInterface;
use App\Domain\Interfaces\Post\PostServiceInterface;
use App\Domain\Models\Post;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use App\Domain\ValueObjects\Post\Comment;
use App\Domain\ValueObjects\Post\Content;
use App\Domain\ValueObjects\Post\Title;
use DateTime;
use Illuminate\Support\Facades\Auth;

class PostService implements PostServiceInterface
{
    /**
     * Create a new class instance.
     */
    private PostRepositoryInterface $postRepositoryInterface;

    public function __construct(PostRepositoryInterface $postRepositoryInterface)
    {
        $this->postRepositoryInterface = $postRepositoryInterface;
    }

    public function create(PostDTO $postDTO): void
    {
        $post = new Post(
            new Title($postDTO->title),
            new Content($postDTO->content),
            $postDTO->author,
            new DateTime($postDTO->createdAt),
            new DateTime($postDTO->updatedAt)
        );
        $this->postRepositoryInterface->save($post);
    }

    public function like(int $postId): void
    {
        $authUser = Auth::user();
        if (!$authUser instanceof User) {
            $user = new User(
                $authUser->name,
                new Email($authUser->email),
                new Password($authUser->password)
            );
        }

        $post = $this->postRepositoryInterface->findById($postId);
        $post->addLike($user);
        $this->postRepositoryInterface->save($post);
    }

    public function comment(int $postId, CommentDTO $commentDTO): void
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

    $post = $this->postRepositoryInterface->findById($postId);

    $post->addComment($user, new Comment($commentDTO->comment));

    $this->postRepositoryInterface->save($post);
}

    public function delete(int $postId): void
    {
        $post = $this->postRepositoryInterface->findById($postId);
        $this->postRepositoryInterface->delete($post);
    }
}
