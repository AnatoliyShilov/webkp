@extends('layouts/show')

@section('pageName', 'Просмотр пользователя ' . $user->name)

@section('urlEdit', url('/users/' . $user->id . '/edit'))
@section('urlDelete', url('/users/' . $user->id))

@section('displayFields')
    <label>id: {{ $user->id }}</label><br>
    <label>Имя: {{ $user->name }}</label><br>
    <label>Привилегия: 
        @if ($user->role == 0)
            Администратор
        @else
            Пользователь
        @endif
    </label><br>
    <label>email: {{ $user->email }}</label><br>
    <hr>
    @foreach ($userOrders as $userOrder)
        <label>Заказ: <a class="btn btn-primary" href={{ url('/userorders/' . $userOrder->id)}}>{{ $userOrder->id }}</a></label><br>
        <label>Статус: {{ $userOrder->statusRec->name }}</label>
        <hr>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $userOrders->links() }}
    </div>
@endsection