@extends('layouts.create')

@section('pageName', 'Создание новый типа оплаты')

@section('urlStore', url('/paytypes'))

@section('inputFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name">     
@endsection