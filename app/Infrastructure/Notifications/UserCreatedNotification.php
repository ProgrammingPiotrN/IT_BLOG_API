<?php

namespace App\Infrastructure\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreatedNotification extends Notification implements ShouldQueue
{
    /**
     * Create a new class instance.
     */
    use Queueable;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Użytkownik utworzony')
            ->greeting('Witaj!')
            ->line("Użytkownik {$this->user->name} został pomyślnie utworzony.")
            ->action('Zobacz użytkownika', url('/users/' . $this->user->id))
            ->line('Dziękujemy za korzystanie z naszej aplikacji!');
    }
}
