@extends('layouts.edit')

@section('pageName', 'Редактирование пользователя ' . $user->name)

@section('urlUpdate', url('/users/' . $user->id))

@section('updateFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name" value={{ $user->name }}>
    <label for="roleinput">Привилегия</label>
    <select class="form-control" id="roleinput" name="role" value={{ $user->role }}>
        <option></option>
        <option value="0">Администратор</option>
        <option value="1">Пользователь</option>
    </select>
    <label for="emailinput">email</label>
    <input class="form-control" id="emailinput" type="text" name="email" value={{ $user->email }}>
    <label for="passwordinput">Пароль</label>
    <input class="form-control" id="passwordinput" type="text" name="password" value={{ $user->password }}>
@endsection