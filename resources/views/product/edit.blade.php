@extends('layouts.edit')

@section('pageName', 'Редактирование товара ' . $product->name)

@section('urlUpdate', url('/products/' . $product->id))

@section('updateFields')
    <label for="nameinput">Название</label>
    <input class="form-control" id="nameinput" type="text" name="name" value={{ $product->name }}><br>
    <label for="descriptioninput">Описание</label><br>
    <label>{{ $product->description }}</label>
    <textarea class="form-control" id="descriptioninput" type="text" name="description" value={{ $product->description }}></textarea><br>
    <label for="costinput">Стоимость</label>
    <input class="form-control" id="costinput" type="text" name="cost" value={{ $product->cost }}><br>
    <label for="typeinput">Тип</label>
    <select class="form-control" id="typeinput" name="type">
        <option value={{ $product->type }}>{{ $product->typeRec->name }}</option>
        @foreach ($types as $type)
            <option value={{ $type->id }}>{{ $type->name }}</option>
        @endforeach
    </select><br>
@endsection