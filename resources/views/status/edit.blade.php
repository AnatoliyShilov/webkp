@extends('layouts.edit')

@section('pageName', 'Редактирование вида состояния заказов ' . $status->name)

@section('urlUpdate', url('/statuses/' . $status->id))

@section('updateFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name" value="{{ $status->name }}">
@endsection