<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendVerify extends Notification
{
    use Queueable;
    private  $user;
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
                    ->line('The notification.')
                    ->action('Notification Action', route('verify',$this->user->token))
                    ->line('Thank you for using our application!');
    }
}
