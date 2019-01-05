@extends('layouts.create')

@section('pageName', 'Создание нового товара')

@section('urlStore', url('/products'))

@section('enctype', 'enctype="multipart/form-data"')

@section('inputFields')
    <label for="nameinput">Название</label>
    <input class="form-control" id="nameinput" type="text" name="name"><br>
    <label for="descriptioninput">Описание</label>
    <textarea class="form-control" id="descriptioninput" type="text" name="description"></textarea><br>
    <label for="costinput">Стоимость</label>
    <input class="form-control" id="costinput" type="text" name="cost"><br>
    <label for="typeinput">Тип</label>
    <select class="form-control" id="typeinput" name="type">
        <option></option>
        @foreach ($types as $type)
            <option value={{ $type->id }}>{{ $type->name }}</option>
        @endforeach
    </select><br>
    <input class="form-control-file" type="file" name="images[]" multiple><br>   
@endsection