<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReminderNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $reminder;

    public function __construct($reminder)
    {
        $this->reminder = $reminder;
    }

    public function build()
    {
        return $this->view('emails.reminder_notification')
                ->with([
                    'title' => $this->reminder->title,
                    'date' => $this->reminder->date
                ]);
    }
}
