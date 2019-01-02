@extends('layouts.create')

@section('pageName', 'Создание нового вида состояния заказов')

@section('urlStore', url('/statuses'))

@section('inputFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name">
@endsection