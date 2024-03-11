@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 form-block">
            <div class="form-title">
                Додати нове нагадування
            </div>
            <form action="{{ route('reminder.store') }}" method="POST" class="form">
                @csrf
                <div class="form-top">
                    <input type="text" placeholder="Введіть текст" name='title' class="form-control">
                    <input type="color" name='color' class="form-control form-control-color">
                </div>
                <input type="datetime-local" name='date' class="form-control">
                <select class="form-select" name='regularity'>
                    <option value="once">Одноразово</option>
                    <option value="everyday">Кожного дня</option>
                    <option value="monthly">Кожного місяця</option>
                    <option value="yearly">Кожного року</option>
                </select>
                <button type="submit" class="btn btn-success">
                    Зберегти
                </button>
            </form>
        </div>
    </div>
@endsection
