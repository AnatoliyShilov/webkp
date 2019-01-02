@extends('layouts.app')

@section('pageName', 'Пользователи')

@section('contentSection')
    <div class="vspacer10px"></div>
    <a class="btn btn-primary" href={{ url('/users/create') }}>Создать</a>
    <div class="vspacer10px"></div>
    <hr>
    @foreach ($users as $user)
        <p>
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/users/' . $user->id) }}>{{ $user->name }}</a>
                <div class="hspacer10px"></div>
                <a class="btn btn-primary" href={{ url('/users/' . $user->id . '/edit') }}>Редактировать</a>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/users/' . $user->id) }}>
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type="submit">Удалить</button>
                </form>
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $users->links() }}
    </div>
@endsection