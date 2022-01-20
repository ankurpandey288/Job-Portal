<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * JobNotification constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(config('mail.from.address'))
            ->subject('New Job Notification')->markdown('emails.jobs.notification');
    }
}
