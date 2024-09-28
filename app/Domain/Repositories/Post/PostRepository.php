<?php

namespace App\Domain\Repositories\Post;

use App\Domain\Interfaces\Post\PostRepositoryInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\Post;
use App\Domain\ValueObjects\Post\Content;
use App\Domain\ValueObjects\Post\Title;
use DateTime;
use PDO;

class PostRepository implements PostRepositoryInterface
{
    private PDO $db;
    private UserRepositoryInterface $userRepo;

    public function __construct(PDO $dbConnection, UserRepositoryInterface $userRepo)
    {
        $this->db = $dbConnection;
    }

    public function save(Post $post): void
    {
        if ($post->getId() === null) {
            $stmt = $this->db->prepare("
                INSERT INTO posts (title, content, created_at, updated_at)
                VALUES (:title, :content, :created_at, :updated_at)
            ");
            $stmt->execute([
                'title' => $post->getTitle()->getValue(),
                'content' => $post->getContent()->getValue(),
                'created_at' => $post->getCreatedAt(),
                'updated_at' => $post->getUpdatedAt(),
            ]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE posts
                SET title = :title, content = :content, updated_at = :updated_at
                WHERE id = :id
            ");
            $stmt->execute([
                'title' => $post->getTitle()->getValue(),
                'content' => $post->getContent()->getValue(),
                'updated_at' => $post->getUpdatedAt(),
                'id' => $post->getId(),
            ]);
        }
    }

    public function findById(int $id): ?Post
    {
        $stmt = $this->db->prepare("
            SELECT id, title, content, author_id, created_at, updated_at
            FROM posts
            WHERE id = :id
        ");
        $stmt->execute(['id' => $id]);
        $postData = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$postData) {
            return null;
        }

        $author = $this->userRepo->findById($postData['author_id']);

        if (!$author) {
            throw new \Exception('Author not found');
        }

        return new Post(
            new Title($postData['title']),
            new Content($postData['content']),
            $author,
            new DateTime($postData['created_at']),
            new DateTime($postData['updated_at'])
        );
    }

    public function delete(Post $post): void
    {
        $stmt = $this->db->prepare("
            DELETE FROM posts
            WHERE id = :id
        ");
        $stmt->execute(['id' => $post->getId()]);
    }
}
