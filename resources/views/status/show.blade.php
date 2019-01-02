@extends('layouts.show')

@section('pageName', 'Просмотр вида состояния заказов ' . $status->name )

@section('urlEdit', url('/statuses/' . $status->id . '/edit'))
@section('urlDelete', url('/statuses/' . $status->id))

@section('displayFields')
    <label>id: {{ $status->id }}</label><br>
    <label>Наименование: {{ $status->name }}</label><br>
@endsection