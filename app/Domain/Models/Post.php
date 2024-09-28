<?php

namespace App\Domain\Models;

use App\Domain\ValueObjects\Post\Comment;
use App\Domain\ValueObjects\Post\Content;
use App\Domain\ValueObjects\Post\Title;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Post extends Model
{
    use HasApiTokens, HasFactory;

    private Title $title;
    private Content $content;
    private User $author;
    private array $likes = [];
    private array $comments = [];

    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function __construct(Title $title, Content $content, User $author,
        DateTime $createdAt, DateTime $updatedAt)
    {
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function addLike(User $user): void
    {
        $this->likes[] = $user;
    }

    public function addComment(User $user, Comment $comment): void
    {
        $this->comments[] = [
            'user' => $user,
            'comment' => $comment,
        ];
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getContent(): Content
    {
        return $this->content;
    }

    public function getLikes(): array
    {
        return $this->likes;
    }

    public function getComments(): array
    {
        return $this->comments;
    }
}
