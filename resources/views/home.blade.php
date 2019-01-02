@extends('layouts.app')

@section('pageName', 'Главная')

@section('contentSection')
    <div class="vspacer10px"></div>
    @foreach ($types as $type)
        <a class="btn btn-primary" href={{ url('/products/type/' . $type->id) }}>{{ $type->name }}</a>
        <div class="vspacer10px"></div>
    @endforeach
@endsection
