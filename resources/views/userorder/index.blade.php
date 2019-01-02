@extends('layouts.app')

@section('pageName', 'Заказы')

@section('contentSection')
    <hr>
    @foreach ($userOrders as $userOrder)
        <p>
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/userorders/' . $userOrder->id) }}>№{{ $userOrder->id }} от {{ $userOrder->updated_at }}</a>
                <div class="hspacer10px"></div>
                <a class="btn btn-primary" href={{ url('/userorders/' . $userOrder->id . '/edit') }}>Изменить статус</a>
                <div class="hspacer10px"></div>
                {{ $userOrder->statusRec->name }}
            </div>
        </p>
    @endforeach
@endsection