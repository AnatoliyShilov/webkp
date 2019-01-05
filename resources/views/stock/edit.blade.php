@extends('layouts.edit')

@section('pageName', 'Редактирование акции ' . $stock->name)

@section('urlUpdate', url('/stocks/' . $stock->id))

@section('updateFields')
    <label for="nameinput">Название</label>
    <input class="form-control" id="nameinput" type="text" name="name" value={{ $stock->name }}><br>
    <label for="discountinput">Скидка в процентах</label>
    <input class="form-control" id="discountinput" type="text" name="discount" value={{ $stock->discount }}><br>
    <label for="ablefrominput">С</label>
    <input class="form-control" id="ablefrominput" type="date" name="ablefrom" value={{ $stock->ablefrom }}><br>
    <label for="abletoinput">До</label>
    <input class="form-control" id="abletoinput" type="date" name="ableto" value={{ $stock->ableto }}><br>
@endsection