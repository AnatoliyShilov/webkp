@extends('layouts.edit')

@section('pageName', 'Редактирование типа товара ' . $type->name)

@section('urlUpdate', url('/types/' . $type->id))

@section('updateFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name" value={{ $type->name }}>
@endsection