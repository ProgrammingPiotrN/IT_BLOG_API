<?php

namespace App\Domain\Models;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_MODERATOR = 'moderator';
    const ROLE_GUEST = 'guest';

    protected  string $name;
    protected  Email $email;
    protected  Password $password;

    public function __construct(string $name, Email $email, Password $password, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->role = $attributes['role'] ?? self::ROLE_GUEST;

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function isModerator(): bool
    {
        return $this->role === self::ROLE_MODERATOR;
    }

    public function isGuest(): bool
    {
        return $this->role === self::ROLE_GUEST;
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): Email {
        return $this->email;
    }

    public function getPassword(): Password {
        return $this->password;
    }

    public static function createFromArray(array $data): self
    {
        return new self($data['name'], new Email($data['email']), new Password($data['password']));
    }

    public static function createEmpty(): self
    {
        return new self('', new Email(''), new Password(''));
    }


    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
