<?php

namespace App\Http\Controllers\Calendar;

use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Reminder\DoneRequest;
use App\Http\Requests\Reminder\PostRequest;
use App\Http\Requests\Reminder\UpdateRequest;

class ReminderController extends Controller
{
    public function index()
    {
        return view('calendar.reminder.index');
    }

    public function store(PostRequest $request)
    {
        $date = $request->validated();
        $date['user_id'] = Auth::user()->id;
        Reminder::create($date);

        return redirect()->route('home');
    }

    public function edit(Reminder $reminder)
    {
        return view('calendar.reminder.edit', ['reminder' => $reminder]);
    }

    public function update(UpdateRequest $request, Reminder $reminder)
    {
        $data = $request->validated();
        $reminder->update($data);

        return redirect()->route('home');
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();

        return redirect()->route('home');
    }

    public function makeDone(DoneRequest $request, Reminder $reminder)
    {
        $data = $request->validated();
        $data['done'] = !$data['done'];
        $data['color'] = '#000000';

        $reminder->update($data);

        return redirect()->route('home');
    }
}
