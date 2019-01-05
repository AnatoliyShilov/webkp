@extends('layouts.app')

@section('pageName', 'Акции')

@section('contentSection')
    @foreach ($stocks as $stock)
        <p>
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href={{ url('/products/' . $stock->product) }}>
                        {{ $stock->name }}
                    </a>
                </div>
                <div class="card-body">
                    С {{ date_format(date_create($stock->ablefrom), 'd.m.Y') }} до {{ date_format(date_create($stock->ableto), 'd.m.Y') }}<br>
                    Скидка: {{ $stock->discount }}%<br>
                    Товар: <a class="btn btn-primary" href={{ url('/products/' . $stock->product) }}>
                        {{ $stock->productRec->name }}
                    </a>
                </div>
            </div>
            <div class="vspacer10px"></div>
            <div class="d-flex">
                @if (Auth::check())
                    @if (Auth::user()->role == 0)
                        <div class="hspacer10px"></div>
                        <a class="btn btn-primary" href={{ url('/stocks/' . $stock->id . '/edit') }}>
                            Редактировать
                        </a>
                        <div class="hspacer10px"></div>
                        <form method="post" action={{ url('/stocks/' . $stock->id) }}>
                            @csrf
                            @method('delete')
                            <button class="btn btn-primary" type="submit">
                                Удалить
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $stocks->links() }}
    </div>
@endsection