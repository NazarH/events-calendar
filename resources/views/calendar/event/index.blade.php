@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 form-block">
            <div class="form-title">
                Додати новий івент
            </div>
            <form action="{{ route('event.store') }}" method="POST" class="form">
                @csrf
                <div class="form-top">
                    <input type="text" placeholder="Введіть текст" name='title' class="form-control">
                    <input type="color" name='color' class="form-control form-control-color">
                </div>
                <input type="datetime-local" name='start_date' class="form-control">
                <input type="datetime-local" name='end_date' class="form-control">
                <button type="submit" class="btn btn-success">
                    Зберегти
                </button>
            </form>
        </div>
    </div>
@endsection
