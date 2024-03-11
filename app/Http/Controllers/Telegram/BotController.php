<?php

namespace App\Http\Controllers\Telegram;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{
    public function setWebhook()
    {
        $response = Telegram::setWebhook(['url' => 'https://b2b4-188-163-37-185.ngrok-free.app/bot/webhook']);
        return $response;
    }

    public function handle(Request $request)
    {
        $update = Telegram::getWebhookUpdates();

        if (isset($update['message']['chat']['id'])) {
            $chatId = $update['message']['chat']['id'];
            $userEmail = $update['message']['text'];

            $user = User::where('email', $userEmail)->first();

            if ($user && $user->telegram_token === null) {
                $user->update(
                    [
                        'telegram_token' => $chatId
                    ]
                );

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Вітаємо! Тепер ви отримуватимете сповіщення з ресурсу EventsCalendar.',
                ]);

            } else if($user->telegram_token) {

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Ви вже підписані на сповіщення.',
                ]);

            } else {

                Telegram::sendMessage([
                    'chat_id' => $chatId,
                    'text' => 'Користувача з вказаною електронною адресою не знайдено.',
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    }
}
