@extends('layouts.app')

@section('pageName', 'Типы доставки')

@section('contentSection')
    <div class="vspacer10px"></div>
    <a class="btn btn-primary" href={{ url('/deliverytypes/create') }}>Создать</a>
    <div class="vspacer10px"></div>
    <hr>
    @foreach ($deliveryTypes as $deliveryType)
        <p> 
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/deliverytypes/' . $deliveryType->id) }}>{{ $deliveryType->name }}</a>
                <div class="hspacer10px"></div>
                <a class="btn btn-primary" href={{ url('/deliberytypes/' . $deliveryType->id . '/edit') }}>Редактировать</a>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/deliverytypes/' . $deliveryType->id) }}>
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type="submit">Удалить</button>
                </form>
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $deliveryTypes->links() }}
    </div>
@endsection