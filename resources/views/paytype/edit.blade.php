@extends('layouts.edit')

@section('pageName', 'Редактирование способа оплаты ' . $payType->name)

@section('urlUpdate', url('/paytypes/'. $payType->id))

@section('updateFields')
    <label for="nameinput">Наименование</label>
    <input class="form-control" id="nameinput" type="text" name="name" value={{ $payType->name }}>
@endsection