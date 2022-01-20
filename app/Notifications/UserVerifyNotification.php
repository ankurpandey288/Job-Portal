<?php

namespace App\Notifications;

use App\Models\EmailTemplate;
use Auth;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserVerifyNotification extends VerifyEmail implements ShouldQueue
{
    use Queueable;

    public $user;            //you'll need this to address the user

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user = '')
    {
        $this->user = $user ?: Auth::user();         //if user is not supplied, get from session
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);     //verificationUrl required for the verification link
        $user = $this->user;
        /** @var EmailTemplate $templateBody */
        $templateBody = EmailTemplate::whereTemplateName('Verify Email')->first();
        $keyVariable = ['{{user_name}}', '{{verify_url}}', '{{from_name}}'];
        $value = [$user->full_name, $url, config('app.name')];
        $body = str_replace($keyVariable, $value, $templateBody->body);
        $data['body'] = $body;

        return (new MailMessage)
            ->subject($templateBody->subject)
            ->view('emails.verify_email', $data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
