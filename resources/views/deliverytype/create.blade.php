@extends('layouts.create')

@section('pageName', 'Создание нового способа доставки')

@section('urlStore', url('/deliverytypes'))

@section('inputFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name">
@endsection