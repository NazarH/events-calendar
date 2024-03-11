<?php

namespace App\Http\Controllers\Calendar;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Event\PostRequest;
use App\Http\Requests\Event\UpdateRequest;
use App\Http\Requests\Reminder\DoneRequest;

class EventController extends Controller
{
    public function index()
    {
        return view('calendar.event.index');
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        Event::create($data);

        return redirect()->route('home');
    }

    public function edit(Event $event)
    {
        return view('calendar.event.edit', ['event' => $event]);
    }

    public function update(UpdateRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->update($data);

        return redirect()->route('home');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('home');
    }

    public function makeDone(DoneRequest $request, Event $event)
    {
        $data = $request->validated();
        $data['done'] = !$data['done'];
        $data['color'] = '#000000';

        $event->update($data);

        return redirect()->route('home');
    }

}
