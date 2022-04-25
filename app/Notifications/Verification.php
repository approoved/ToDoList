<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

final class Verification extends Notification implements ShouldQueue
{
    use Queueable;
    
    public function __construct(private User $user)
    {
    }

    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(mixed $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hello, ' . $this->user->first_name . $this->user->last_name)
            ->subject('Email verification')
            ->line('Verify your email by clicking button below')
            ->action('Verify', route('email.verify', $this->user->token))
            ->line('Thank you for using our application!');
    }
}
