<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Reminder;

use App\Mail\EventStarted;
use App\Mail\EventFinished;
use App\Mail\ReminderNotification;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

use App\Telegram\Bot\TelegramNotificationService;

class SendEventReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send reminders for upcoming events and finished events';

    public function handle()
    {
        $currentTime = now();
        $oneMonth = $currentTime->diffInMinutes($currentTime->copy()->addMonthNoOverflow()->endOfMonth());
        $oneYear = $currentTime->diffInMinutes($currentTime->copy()->addYearNoOverflow()->endOfYear());
        $oneYear--;

        $startedEvents = Event::startedEvents($currentTime)->with('user')->get();
        $finishedEvents = Event::endedEvents($currentTime)->with('user')->get();
        $reminders = Reminder::started($currentTime)->with('user')->get();

        foreach ($startedEvents as $event) {
            if (!Cache::has('event_started_'.$event->id.'_start')) {
                $this->sendEventReminder(
                    $event,
                    EventStarted::class,
                    'sendEventStartedNotification',
                    'event start reminder',
                    true, false, false,
                    '_start',
                    null
                );
            }
        }

        foreach ($finishedEvents as $event) {
            $this->sendEventReminder(
                $event,
                EventFinished::class,
                'sendEventFinishedNotification',
                'event finish reminder',
                false, true, true,
                '_start',
                null
            );
        }

        foreach ($reminders as $reminder) {
            if ($reminder->regularity === 'once') {
                $this->sendEventReminder(
                    $reminder,
                    ReminderNotification::class,
                    'sendReminderNotification',
                    'reminder',
                    false, false, true,
                    '_once',
                    null
                );
            }

            if ($reminder->regularity === 'everyday') {
                if (!Cache::has('date_'.$reminder->id.'_everyday')) {
                    $this->sendEventReminder(
                        $reminder,
                        ReminderNotification::class,
                        'sendReminderNotification',
                        'reminder',
                        true, false, false,
                        '_everyday',
                        23 * 60 + 59
                    );
                }
            }

            if ($reminder->regularity === 'monthly') {
                if (!Cache::has('date_'.$reminder->id.'_monthly')) {
                    $this->sendEventReminder(
                        $reminder,
                        ReminderNotification::class,
                        'sendReminderNotification',
                        'reminder',
                        true, false, false,
                        '_monthly',
                        $oneMonth
                    );
                }
            }

            if ($reminder->regularity === 'yearly') {
                if (!Cache::has('date_'.$reminder->id.'_yearly')) {
                    $this->sendEventReminder(
                        $reminder,
                        ReminderNotification::class,
                        'sendReminderNotification',
                        'reminder',
                        true, false, false,
                        '_yearly',
                        $oneYear
                    );
                }
            }
        }
    }

    public function sendEventReminder($element, $class, $method, $for, $put, $delete, $update, $period, $time)
    {
        Mail::to($element->user->email)->send(new $class($element));

        if ($element->user->telegram_token) {
            (new TelegramNotificationService())->$method($element);
        }

        Log::info('Sent ' . $for . ' for event: ' . $element->title);

        if ($put) {
            Cache::put('date_' . $element->id . $period, true, $time);
        }

        if ($delete) {
            Cache::delete('event_started_' . $element->id . $period);
        }

        if ($update) {
            $element->update(
                [
                    'done' => true
                ]
            );
        }
    }

}
