@extends('layouts.home')
@section('content')
    <div class="row">
        <div class="col-12 form-block">

            <form action="{{ route('cabinet.update', $user->id) }}" class="form">
                <input type="text" name='name' class="form-control" placeholder="Введіть нове ім'я"
                    value="{{ $user->name }}">
                <input type="email" name='email'class="form-control" placeholder="Введіть новий емейл"
                    value="{{ $user->email }}">
                <input type="password" name='password' class="form-control" placeholder="Новий пароль">
                <input type="password" name='password_confirmation' class="form-control"
                    placeholder="Повторіть новий пароль">

                <button type='submit' class="btn btn-success">
                    Зберегти
                </button>
            </form>

        </div>
    </div>
@endsection
