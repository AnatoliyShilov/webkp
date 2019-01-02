@extends('layouts.create')

@section('pageName', 'Создание нового тип товара')

@section('urlStore', url('/types'))

@section('inputFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name">
@endsection