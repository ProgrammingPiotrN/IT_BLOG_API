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
        $this->db = $dbConnection;
    }

    public function save(User $user): void
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([
            $user->getName(),
            $user->getEmail()->getValue(),
            password_hash($user->getPassword()->getValue(), PASSWORD_DEFAULT),
        ]);
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new User($data['name'], $data['email'], new Password($data['password']));
    }
}
