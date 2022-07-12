<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $url = rtrim(config('app.url'), '/') . '/restore?token=' . $this->token.'&email='.$notifiable->getEmailForPasswordReset();

        return (new MailMessage)
                    ->subject(__('site_labels.restore_password_email'))
                    ->view('emails.auth.reset', ['url' => $url]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
