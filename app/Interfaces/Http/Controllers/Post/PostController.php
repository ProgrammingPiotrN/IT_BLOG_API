<?php

namespace App\Interfaces\Http\Controllers\Post;

use App\Application\Commands\Post\CommentOnPostCommand;
use App\Application\Commands\Post\CreatePostCommand;
use App\Application\Commands\Post\DeletePostCommand;
use App\Application\Commands\Post\LikePostCommand;
use App\Application\DTOs\Post\CommentDTO;
use App\Application\DTOs\Post\PostDTO;
use App\Application\UseCases\Post\CommentOnPostUseCase;
use App\Application\UseCases\Post\CreatePostUseCase;
use App\Application\UseCases\Post\DeletePostUseCase;
use App\Application\UseCases\Post\LikePostUseCase;
use App\Domain\Interfaces\Post\PostRepositoryInterface;
use App\Domain\Models\Post;
use App\Domain\Models\User;
use App\Interfaces\Http\Controllers\Controller;
use App\Interfaces\Http\Requests\Post\CommentOnPostRequest;
use App\Interfaces\Http\Requests\Post\CreatePostRequest;
use App\Interfaces\Http\Requests\Post\DeletePostRequest;
use App\Interfaces\Http\Requests\Post\LikePostRequest;
use App\Interfaces\Http\Resources\Post\PostResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controller as BaseController;



class PostController extends BaseController
{
    public function __construct(
        private CreatePostUseCase $createPostUseCase,
        private LikePostUseCase $likePostUseCase,
        private CommentOnPostUseCase $commentOnPostUseCase,
        private DeletePostUseCase $deletePostUseCase,

        private PostRepositoryInterface $postRepositoryInterface
    ) {}

    public function create(CreatePostRequest $request)
    {
        $authUser = Auth::user();

        if (!$authUser) {
            return response()->json(['message' => 'Użytkownik musi być zalogowany, aby utworzyć post'], 401);
        }

        $user = $authUser instanceof User ? $authUser : null;

        if (!$user) {
            return response()->json(['message' => 'User must be have a logged'], 401);
        }

        $this->authorize('create', Post::class);

        $postDTO = new PostDTO(
            title: $request->get('title'),
            content: $request->get('content'),
            author: $user,
            createdAt: now()->toString(),
            updatedAt: now()->toString()
        );

        $command = new CreatePostCommand($postDTO, $user); // Przekaż użytkownika

        $this->createPostUseCase->execute($command, $user); // Powinno być tylko dwa argumenty

        return response()->json(['message' => 'Post successful created']);
    }

    public function like(LikePostRequest $request, int $postId)
    {
        $post = $this->postRepositoryInterface->findById($postId);

        $this->authorize('like', $post);

        $command = new LikePostCommand($postId);
        $this->likePostUseCase->execute($command);

        return response()->json(['message' => 'Post liked successfully']);
    }

    public function comment(CommentOnPostRequest $request, int $postId)
    {
        $post = $this->postRepositoryInterface->findById($postId);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $user = Auth::user();

        if (!$user || !$user instanceof User) {
            return response()->json(['message' => 'User must be logged in to comment'], 401);
        }

        $this->authorize('comment', $post);

        $commentDTO = new CommentDTO($request->get('comment'));

        $command = new CommentOnPostCommand($post, $user, $commentDTO);

        $this->commentOnPostUseCase->execute($command);

        return response()->json(['message' => 'Comment added successfully']);
    }

    public function delete(DeletePostRequest $request, int $postId)
    {
        $post = $this->postRepositoryInterface->findById($postId);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'User must be logged in to delete a post'], 401);
        }

        $this->authorize('delete', $post);

        $command = new DeletePostCommand($post);

        $this->deletePostUseCase->execute($command);

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function show(int $postId)
    {
        $post = $this->postRepositoryInterface->findById($postId);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        return new PostResource($post);
    }
}
