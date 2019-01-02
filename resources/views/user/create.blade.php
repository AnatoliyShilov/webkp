@extends('layouts.create')

@section('pageName', 'Создание нового пользователя')

@section('urlStore', url('/users'))

@section('inputFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name">
    <label for="roleinput">Привилегия</label>
    <select class="form-control" id="roleinput" name="role">
        <option></option>
        <option value="0">Администратор</option>
        <option value="1">Пользователь</option>
    </select>
    <label for="emailinput">email</label>
    <input class="form-control" id="emailinput" type="text" name="email">
    <label for="passwordinput">Пароль</label>
    <input class="form-control" id="passwordinput" type="text" name="password">
@endsection