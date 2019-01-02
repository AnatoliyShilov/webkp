@extends('layouts.show')

@section('pageName', 'Просмотр типа товара ' . $type->name )

@section('urlEdit', url('/types/' . $type->id . '/edit'))
@section('urlDelete', url('/types/' . $type->id))

@section('displayFields')
    <label>id: {{ $type->id }}</label><br>
    <label>Наименование: {{ $type->name }}</label><br>
@endsection