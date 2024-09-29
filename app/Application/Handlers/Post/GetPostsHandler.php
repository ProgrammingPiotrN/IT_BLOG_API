<?php

namespace App\Application\Handlers\Post;

use App\Application\Commands\Post\GetPostsCommand;
use App\Domain\Interfaces\Post\PostServiceInterface;

class GetPostsHandler
{
    private PostServiceInterface $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    public function handle(GetPostsCommand $command)
    {
        $page = $command->getPage();
        $limit = $command->getLimit();

        // Przekazanie parametrów paginacji do serwisu
        return $this->postService->getPaginatedPosts($page, $limit);
    }
}
