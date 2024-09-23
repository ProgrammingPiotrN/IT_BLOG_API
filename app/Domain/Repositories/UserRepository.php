<?php

namespace App\Domain\Repositories;

use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Models\User;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    private PDO $db;

    public function __construct(PDO $dbConnection)
    {
        $this->db = $dbConnection; // Zainicjalizuj połączenie z bazą danych
    }

    public function save(User $user): void
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([
            $user->getName(),
            $user->getEmail()->getValue(),
            password_hash($user->getPassword()->getValue(), PASSWORD_BCRYPT)
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $userData = $stmt->fetch();

        if (!$userData) {
            return null;
        }

        return new User($userData['name'], new Email($userData['email']), new Password($userData['password']));
    }

    public function findAll(int $page = 1, int $limit = 10): array
    {
        $offset = ($page - 1) * $limit;
        $stmt = $this->db->prepare("SELECT name, email FROM users LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();

        return array_map(function($userData) {
            return new User($userData['name'], new Email($userData['email']), new Password(''));
        }, $results);
    }
}
