<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## EventsCalendar. Deployment of the project

- git clone https://github.com/NazarH/events-calendar.git
- Install Composer to local machine
- composer install
- npm install
- Run Apache local server & MySQL (or use Laradock) on local machine
- php artisan migrate
- php artisan db:seed --class=UserSeeder
- php artisan db:seed --class=EventSeeder
- php artisan db:seed --class=ReminderSeeder
- php artisan serve
- npm run dev
- Install ngrok (and register a new account)
- Use command to access to ngrok server (in command line)
- Add generated adress, from ngrok, to method "setWebhook()" in Telegram/BotController
- Subscribe to bot - https://t.me/EventRemindersNotificationBot & send message with registered email
- Mailtrap was used to send mail locally (need to register and attach it to the .env file)
- php artisan schedule:work

## EventsCalendar. Execution time

- Creation of the main functionality of the calendar, and creation of factories - 5 hours
- Implementation of sending letters to the post office, using queues - 2 hours
- Creation of a chat bot in Telegram, development of subscription logic, and notifications - 8 hours
- Refactoring - 1.5 hour


