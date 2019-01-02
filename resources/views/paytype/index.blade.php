@extends('layouts.app')

@section('pageName', 'Типы оплаты')

@section('contentSection')
    <div class="vspacer10px"></div>
    <a class="btn btn-primary" href={{ url('/paytypes/create') }}>Создать</a>
    <div class="vspacer10px"></div>
    <hr>
    @foreach ($payTypes as $payType)
        <p>
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/paytypes/' . $payType->id) }}>{{ $payType->name }}</a>
                <div class="hspacer10px"></div>
                <a class="btn btn-primary" href={{ url('/paytypes/' . $payType->id . '/edit') }}>Редактировать</a>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/paytypes/' . $payType->id) }}>
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type="submit">Удалить</button>
                </form>
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $payTypes->links() }}
    </div>
@endsection