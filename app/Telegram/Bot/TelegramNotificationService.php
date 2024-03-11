<?php

namespace App\Telegram\Bot;

use Telegram\Bot\Api;

class TelegramNotificationService
{
    protected $telegram;
    protected $token;

    public function __construct()
    {
        $this->telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
    }

    public function sendEventStartedNotification($event)
    {
        $message = "Розпочинається подія '{$event->title}' о '{$event->start_date}'";
        $chatId = $event->user->telegram_token;
        $this->telegram->sendMessage(['chat_id' => $chatId, 'text' => $message]);
    }

    public function sendEventFinishedNotification($event)
    {
        $message = "Завершення події '{$event->title}' о '{$event->end_date}'";
        $chatId = $event->user->telegram_token;
        $this->telegram->sendMessage(['chat_id' => $chatId, 'text' => $message]);
    }

    public function sendReminderNotification($reminder)
    {
        $message = "Ваше нагадування '{$reminder->title}' для дати '{$reminder->date}'";
        $chatId = $reminder->user->telegram_token;
        $this->telegram->sendMessage(['chat_id' => $chatId, 'text' => $message]);
    }
}

