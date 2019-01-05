@extends('layouts.create')

@section('pageName', 'Создание новости')

@section('urlStore', url('/news'))

@section('inputFields')
    <label for="titleinput">Заголовок</label>
    <input class="form-control" id="titleinput" type="text" name="title"><br>
    <label for="textinput">Текст новости</label>
    <textarea class="form-control" id="textinput" type="text" name="text"></textarea><br>
@endsection