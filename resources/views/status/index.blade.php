@extends('layouts.app')

@section('pageName', 'Виды состояний заказов')

@section('contentSection')
    <div class="vspacer10px"></div>
    <a class="btn btn-primary" href={{ url('/statuses/create') }}>Создать</a>
    <div class="vspacer10px"></div>
    <hr>
    @foreach ($statuses as $status)
        <p>
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/statuses/' . $status->id) }}>{{ $status->name }}</a>
                <div class="hspacer10px"></div>
                <a class="btn btn-primary" href={{ url('/statuses/' . $status->id . '/edit') }}>Редактировать</a>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/statuses/' . $status->id) }}>
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type="submit">Удалить</button>
                </form>
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $statuses->links() }}
    </div>
@endsection