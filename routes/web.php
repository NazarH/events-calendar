<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Telegram\BotController;
use App\Http\Controllers\Calendar\EventController;
use App\Http\Controllers\Cabinet\CabinetController;
use App\Http\Controllers\Calendar\CalendarController;
use App\Http\Controllers\Calendar\ReminderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => '/'], function(){
        Route::get('')
            ->uses([CalendarController::class, 'index'])
            ->name('home');

        Route::group(['prefix' => 'form'], function(){

            Route::group(['prefix' => 'event'], function(){
                Route::get('')
                    ->uses([EventController::class, 'index'])
                    ->name('event.index');
                Route::post('store')
                    ->uses([EventController::class, 'store'])
                    ->name('event.store');

                Route::group(['prefix' => 'edit/{event}'], function(){
                    Route::get('')
                        ->uses([EventController::class, 'edit'])
                        ->name('event.edit');
                    Route::post('/update')
                        ->uses([EventController::class, 'update'])
                        ->name('event.update');
                    Route::delete('/delete')
                        ->uses([EventController::class, 'destroy'])
                        ->name('event.delete');
                    Route::post('/done')
                        ->uses([EventController::class, 'makeDone'])
                        ->name('event.done');
                });
            });

            Route::group(['prefix' => 'reminder'], function(){
                Route::get('')
                    ->uses([ReminderController::class, 'index'])
                    ->name('reminder.index');
                Route::post('store')
                    ->uses([ReminderController::class, 'store'])
                    ->name('reminder.store');

                Route::group(['prefix' => 'edit/{reminder}'], function(){
                    Route::get('')
                        ->uses([ReminderController::class, 'edit'])
                        ->name('reminder.edit');
                    Route::post('/update')
                        ->uses([ReminderController::class, 'update'])
                        ->name('reminder.update');
                    Route::delete('/delete')
                        ->uses([ReminderController::class, 'destroy'])
                        ->name('reminder.delete');
                    Route::post('/done')
                        ->uses([ReminderController::class, 'makeDone'])
                        ->name('reminder.done');
                });
            });
        });

        Route::group(['prefix' => 'cabinet'], function(){
            Route::get('')
                ->uses([CabinetController::class, 'index'])
                ->name('cabinet.index');
            Route::get('/update/{user}')
                ->uses([CabinetController::class, 'update'])
                ->name('cabinet.update');
        });
    });
});

Route::match(['get', 'post'], '/bot/webhook', [BotController::class, 'handle']);

