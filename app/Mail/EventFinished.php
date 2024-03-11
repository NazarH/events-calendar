<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventFinished extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function build()
    {
        return $this->view('emails.event_finished')
                    ->with([
                        'title' => $this->event->title,
                        'end' => $this->event->end_date
                    ]);
    }
}
