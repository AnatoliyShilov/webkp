@extends('layouts/app')

@section('contentSection')
    <div class="vspacer10px"></div>
    @section('btnsEditDelete')
        @if (Auth::check())
            @if (Auth::user()->role == 0)
                <div class="d-flex">
                    <a class="btn btn-primary" href=@yield('urlEdit')>Редактировать</a>
                    <div class="hspacer10px"></div>
                    <form method="post" action=@yield('urlDelete')>
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary" type="submit">Удалить</button>
                    </form>
                </div>
            @endif
        @endif
    @show
    <hr>
    <div class="vspacer10px"></div>
    @section('displayFields')
    @show
@endsection