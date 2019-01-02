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
    <form action=@yield('urlUpdate') method="post" @yield('enctype')>
        @csrf
        @method('put')
        @section('updateFields')
        @show
        <div class="vspacer10px"></div>
        <button class="btn btn-primary" type="submit">Обновить</button>
    </form>
    <div class="vspacer10px"></div>
@endsection