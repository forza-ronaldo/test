<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class resetPassword extends Notification
{
    use Queueable;
    private $user;
    public function __construct($user)
    {
        $this->user=$user;
    }
    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('reset password')
                    ->action('click here to reset password', route('showSetNewPassword',$this->user->token_reset_password))
                    ->line('Thank you for using our application!');
    }
}
