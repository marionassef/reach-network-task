<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdReminderMail extends Mailable implements ShouldQueue
{
    public $subject;
    public $user;
    public $ad;

    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param $user
     * @param $ad
     */
    public function __construct($subject, $user, $ad)
    {
        $this->subject = $subject;
        $this->user = $user;
        $this->ad = $ad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): AdReminderMail
    {
        return $this->view('emails.adReminder')->subject($this->subject)
            ->with(['user' => $this->user, 'ad' => $this->ad]);
    }
}
