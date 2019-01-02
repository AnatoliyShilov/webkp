@extends('layouts.app')

@section('contentSection')
    <div class="vspacer10px"></div>
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action=@yield('urlStore') method="post" @yield('enctype')>
        @csrf
        @section('inputFields')
        @show
        <div class="vspacer10px"></div>
        <button class="btn btn-primary" type="submit">Создать</button>
    </form>
    <div class="vspacer10px"></div>
@endsection