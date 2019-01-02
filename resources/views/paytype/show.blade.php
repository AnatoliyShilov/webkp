@extends('layouts/show')

@section('pageName', 'Просмотр типа оплаты ' . $payType->name)

@section('urlEdit', url('/paytypes/' . $payType->id . '/edit'))
@section('urlDelete', url('/paytypes/' . $payType->id))

@section('displayFieds')
    <label>id: {{ $payType->id }}<br>
    <label>Наименование: {{ $payType->name }}</label><br>
@endsection