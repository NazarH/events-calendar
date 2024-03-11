@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 form-block">
            <form action="{{ route('reminder.done', $reminder->id) }}" class="done-form" method="POST">
                @csrf
                <input name="done" type="checkbox" id="eventDone" value="{{ $reminder->done }}"
                    {{ $reminder->done ? 'checked' : '' }}>
                <div>
                    Виконано
                </div>
                <button type="submit" id="done" class="hidden"></button>
            </form>

            <form action="{{ route('reminder.update', $reminder->id) }}" method="POST" class="form">
                @csrf
                <div class="form-top">
                    <input type="text" placeholder="Введіть текст" name='title' class="form-control"
                        value={{ $reminder->title }}>
                    <input type="color" name='color' class="form-control form-control-color"
                        value={{ $reminder->color }}>
                </div>
                <input type="datetime-local" name='date' class="form-control"
                    value="{{ \Carbon\Carbon::parse($reminder->date)->format('Y-m-d\TH:i') }}">
                <select class="form-select" name='regularity'>
                    <option value="once" {{ $reminder->regularity === 'once' ? 'selected' : '' }}>
                        Одноразово
                    </option>
                    <option value="everyday" {{ $reminder->regularity === 'everyday' ? 'selected' : '' }}>
                        Кожного дня
                    </option>
                    <option value="monthly" {{ $reminder->regularity === 'monthly' ? 'selected' : '' }}>
                        Кожного місяця
                    </option>
                    <option value="yearly" {{ $reminder->regularity === 'yearly' ? 'selected' : '' }}>
                        Кожного року
                    </option>
                </select>
                <button type='submit' class="hidden" id="update"></button>
            </form>

            <form action="{{ route('reminder.delete', $reminder->id) }}" method="POST" class="form-delete">
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
