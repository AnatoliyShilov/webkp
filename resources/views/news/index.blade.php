@extends('layouts.app')

@section('pageName', 'Новости')

@section('contentSection')
    @if (Auth::check())
        @if (Auth::user()->role == 0)
            <div class="vspacer10px"></div>
            <a class="btn btn-primary" href={{ url('/news/create') }}>Создать</a>
            <div class="vspacer10px"></div>
        @endif
    @endif
    <hr>
    @foreach ($news as $element)
        <p>
            <div class="card">
                <div class="card-header">
                    <label>{{ $element->title }}: {{ $element->created_at }}</label>
                </div>
                <div class="card-body">
                    {{ $element->text }}
                </div>
            </div>
            @if (Auth::check())
                @if (Auth::user()->role == 0)
                    <div class="vspacer10px"></div>
                    <div class="d-flex">
                        <div class="hspacer10px"></div>
                        <a class="btn btn-primary" href={{ url('/news/' . $element->id . '/edit') }}>Редактировать</a>
                        <div class="hspacer10px"></div>
                        <form method="post" action={{ url('/news/' . $element->id) }}>
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary" type="submit">Удалить</button>
                        </form>
                    </div>
                @endif
            @endif
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $news->links() }}
    </div>
@endsection