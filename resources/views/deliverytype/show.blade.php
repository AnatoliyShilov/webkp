@extends('layouts/show')

@section('pageName', 'Просмотр способа доставки ' . $deliveryType->name)

@section('urlEdit', url('/deliberytypes/' . $deliveryType->id . '/edit'))
@section('urlDelete', url('/deliverytypes/' . $deliveryType->id))

@section('displayFields')
    <label>id: {{ $deliveryType->id }}</label><br>
    <label>Наименование: {{ $deliveryType->name }}</label><br>
@endsection