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

    public function create(User $user, PostDTO $postDTO): Post
    {
        if (!$user->isModerator()) {
            throw new \Exception('Unauthorized action: You must be a moderator to create a post.');
        }

        $post = new Post(
            new Title($postDTO->title),
            new Content($postDTO->content),
            $user,
            new DateTime(),
            new DateTime()
        );

        $this->postRepositoryInterface->save($post);
        return $post;
    }

    public function like(Post $post, User $user): void
    {
        $post->addLike($user);
        $this->postRepositoryInterface->save($post);
    }

    public function comment(Post $post, User $user, CommentDTO $commentDTO): void
    {
        $post->addComment($user, new Comment($commentDTO->comment));
        $this->postRepositoryInterface->save($post);
    }

    public function delete(Post $post): void
    {
        $this->postRepositoryInterface->delete($post);
    }
}
