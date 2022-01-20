<?php

namespace App\Notifications;

use App\Models\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @return MailMessage
     */
    public function toMail(): MailMessage
    {
        /** @var EmailTemplate $templateBody */
        $templateBody = EmailTemplate::whereTemplateName('Password Reset Email')->first();
        $keyVariable = ['{{reset_url}}', '{{from_name}}'];
        $value = [url('password/reset', $this->token), config('app.name')];
        $body = str_replace($keyVariable, $value, $templateBody->body);
        $data['body'] = $body;

        return (new MailMessage)
            ->subject($templateBody->subject)
            ->view('emails.password_reset_email', $data);
    }
}
