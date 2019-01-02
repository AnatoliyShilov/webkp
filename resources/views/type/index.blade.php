@extends('layouts.app')

@section('pageName', 'Типы товаров')

@section('contentSection')
    <div class="vspacer10px"></div>
    <a class="btn btn-primary" href={{ url('/types/create') }}>Создать</a>
    <div class="vspacer10px"></div>
    <hr>
    @foreach ($types as $type)
        <p>
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/types/' . $type->id) }}>{{ $type->name }}</a>
                <div class="hspacer10px"></div>
                <a class="btn btn-primary" href={{ url('/types/' . $type->id . '/edit') }}>Редактировать</a>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/types/' . $type->id) }}>
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type="submit">Удалить</button>
                </form>
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $types->links() }}
    </div>
@endsection