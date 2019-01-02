@extends('layouts.edit')

@section('pageName', 'Изменение статуса заказа №' . $userOrder->id)

@section('urlUpdate', url('/userorders/' . $userOrder->id))

@section('updateFields')
    <label>id: {{ $userOrder->id }}</label><br>
    <label>Адрес: {{ $userOrder->address }}</label><br>
    <label>Способ доставки: {{ $userOrder->deliveryTypeRec->name }}</label><br>
    <label>Способ оплаты: {{ $userOrder->payTypeRec->name }}</label><br>
    <label>Пользователь: {{ $userOrder->userRec->name }}</label><br>
    <label>Статус: {{ $userOrder->statusRec->name }}</label><br>
    <hr>
    <label for="statusinput"></label>
    <select class="form-control" id="statusinput" name="status" >
        <option value={{ $userOrder->status }}>{{ $userOrder->statusRec->name }}</option>
        @foreach ($statuses as $status)
            <option value={{ $status->id }}>{{ $status->name }}</option>
        @endforeach
    </select>
@endsection