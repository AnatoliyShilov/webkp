@extends('layouts.edit')

@section('pageName', 'Редактирование  новости ' . $news->title)

@section('urlUpdate', url('/news/' . $news->id))

@section('updateFields')
    <label for="titleinput">Заголовок</label>
    <input class="form-control" id="titleinput" type="text" name="title" value={{ $news->title }}><br>
    <label for="textinput">Текст новости</label>
    <textarea class="form-control" id="textinput" type="text" name="text">{{ $news->text }}</textarea><br>
@endsection