@extends('layouts.create')

@section('pageName', 'Оформление заказа')

@section('urlStore', url('/userorders'))

@section('inputFields')
    <label for="addressinput">Адрес</label>
    <input class="form-control" id="addressinput" type="text" name="address">
    <label for="deliverytypeinput">Способ доставки</label>
    <select class="form-control" id="deliverytypeinput" name="deliverytype">
        <option></option>
        @foreach ($deliveryTypes as $deliveryType)
            <option value={{ $deliveryType->id }}>{{ $deliveryType->name }}</option>
        @endforeach
    </select>
    <label for="paytypeinput">Способ оплаты</label>
    <select class="form-control" id="paytypeinput" name="paytype">
        <option></option>
        @foreach ($payTypes as $payType)
            <option value={{ $payType->id }}>{{ $payType->name }}</option>
        @endforeach
    </select>
@endsection