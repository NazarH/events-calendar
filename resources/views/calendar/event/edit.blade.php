@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 form-block">
            <form action="{{ route('event.done', $event->id) }}" class="done-form" method="POST">
                @csrf
                <input name="done" type="checkbox" id="eventDone" value="{{ $event->done }}"
                    {{ $event->done ? 'checked' : '' }}>
                <div>
                    Виконано
                </div>
                <button type="submit" id="done" class="hidden"></button>
            </form>

            <form action="{{ route('event.update', $event->id) }}" method="POST" class="form">
                @csrf
                <div class="form-top">
                    <input type="text" placeholder="Введіть текст" name='title' class="form-control"
                        value="{{ $event->title }}">
                    <input type="color" name='color' class="form-control form-control-color"
                        value="{{ $event->color }}">
                </div>
                <input type="datetime-local" name='start_date' class="form-control"
                    value="{{ \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') }}">
                <input type="datetime-local" name='end_date' class="form-control"
                    value="{{ \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') }}">
                <button type='submit' class="hidden" id="update"></button>
            </form>

            <form action="{{ route('event.delete', $event->id) }}" method="POST" class="form-delete">
                @csrf
                @method('delete')
                <button type='submit' class="hidden" id="delete"></button>
            </form>

            <div>
                <button type="submit" class="btn btn-success" id="updateButton">
                    Зберегти
                </button>
                <button type="submit" class="btn btn-danger" id="deleteButton">
                    Видалити
                </button>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/actions.js') }}"></script>
@endsection
