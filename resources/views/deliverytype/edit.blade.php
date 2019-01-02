@extends('layouts.edit')

@section('pageName', 'Редактирование способа доставки ' . $deliveryTypes->name)

@section('urlUpdate', url('/deliverytypes/' . $deliveryTypes->id))

@section('updateFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name" value={{ $deliveryTypes->name }}>
@endsection