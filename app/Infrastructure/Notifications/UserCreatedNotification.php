<?php

namespace App\Infrastructure\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $userName;

    public function __construct(string $userName)
    {
        $this->userName = $userName;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line("A new user, {$this->userName}, has been created.")
            ->action('View Users', url('/users'))
            ->line('Thank you for using our application!');
    }
}
