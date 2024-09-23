<?php

namespace App\Domain\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Exceptions\UserCreationException;
use App\Domain\Exceptions\UserNotFoundException;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\Password;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    private string $name;
    private Email $email;
    private Password $password;

    public function __construct(string $name, Email $email, Password $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
