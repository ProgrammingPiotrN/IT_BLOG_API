<?php

namespace App\Application\Handlers\Post;

use App\Application\Commands\Post\DeletePostCommand;
use App\Domain\Interfaces\Post\PostServiceInterface;

class DeletePostHandler
{
    /**
     * Create a new class instance.
     */
    private PostServiceInterface $postServiceInterface;

    public function __construct(PostServiceInterface $postServiceInterface)
    {
        $this->postServiceInterface = $postServiceInterface;
    }

    public function handle(DeletePostCommand $command)
    {
        $this->postServiceInterface->delete($command->post);
    }
}
