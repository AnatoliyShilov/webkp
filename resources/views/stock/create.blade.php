@extends('layouts.create')

@section('pageName', 'Создание новой акции')

@section('urlStore', url('/stocks/' . $product))

@section('inputFields')
    <label for="nameinput">Название</label>
    <input class="form-control" id="nameinput" type="text" name="name"><br>
    <label for="discountinput">Скидка в процентах</label>
    <input class="form-control" id="discountinput" type="text" name="discount"><br>
    <label for="ablefrominput">С</label>
    <input class="form-control" id="ablefrominput" type="date" name="ablefrom"><br>
    <label for="abletoinput">До</label>
    <input class="form-control" id="abletoinput" type="date" name="ableto"><br>
@endsection