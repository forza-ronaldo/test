<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class addNewQuestion extends Notification
{
    use Queueable;
    private $question;
    public function __construct($question)
    {
        $this->question = $question;
    }
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toArray($notifiable)
    {
        return [
            'data' => [
                'id' => $this->question->id,
                'text_question' => "<a href='questionAwaitingTheAnswer?searsh=" . $this->question->id . "'><p style='margin-bottom: 0px'> يوجد سوال جديد </p>" . $this->question->text_question . "</a>",
                'status_view' => $this->question->status_view,
                'center_type' => $this->question->center_type,
                'user_id' => $this->question->user_id,
                'created_at' => $this->question->created_at,
            ]
        ];
    }
}
