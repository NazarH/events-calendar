<?php

namespace App\Http\Controllers\Calendar;

use App\Models\Event;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::byUser(Auth::user()->id)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date,
                    'end' => $event->end_date,
                    'color' => $event->color
                ];
            });

        $reminders = Reminder::byUser(Auth::user()->id)
            ->get()
            ->map(function ($reminder) {
                return [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'start' => $reminder->date,
                    'color' => $reminder->color,
                ];
            });

        return view('calendar.index', ['events' => $events, 'reminders' => $reminders]);
    }
}
