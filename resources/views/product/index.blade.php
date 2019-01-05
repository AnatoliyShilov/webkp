@extends('layouts.app')

@isset($typeName)
    @section('pageName', 'Товары категории ' . $typeName)
@else
    @section('pageName', 'Товары')
@endisset

@section('contentSection')
    @if (Auth::check())
        @if (Auth::user()->role == 0)
            <div class="vspacer10px"></div>
            <a class="btn btn-primary" href={{ url('/products/create') }}>Создать</a>
            <div class="vspacer10px"></div>
        @endif
    @endif
    <hr>
    @foreach ($products as $product)
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <a class="btn btn-primary" href={{ url('/products/' . $product->id) }}>{{ $product->name }}</a>
                    <div class="hspacer10px"></div>
                    <form method="post" action={{ url('/tobasket/' . $product->id) }}>
                        @csrf
                        <button class="btn btn-primary" type="submit">Заказать</button>
                    </form>
                </div>
                @if (Auth::check())
                    @if (Auth::user()->role == 0)
                        <div class="vspacer10px"></div>
                        <div class="d-flex">
                            <a class="btn btn-primary" href={{ url('/products/' . $product->id . '/edit') }}>Редактировать</a>
                            <div class="hspacer10px"></div>
                            <a class="btn btn-primary" href={{ url('/stocks/create/' . $product->id) }}>Установить скидку</a>
                            <div class="hspacer10px"></div>
                            <form method="post" action={{ url('/products/' . $product->id) }}>
                                @csrf
                                @method('delete')
                                <button class="btn btn-primary" type="submit">Удалить</button>
                            </form>
                        </div>
                    @endif
                @endif
                <div class="vspacer10px"></div>
                <div class="d-flex">
                    @foreach ($product->stocks as $stock)
                        <label>
                            @if (date('Y-m-d H:i:s') >= $stock->ablefrom && date('Y-m-d H:i:s') <= $stock->ableto)
                                {{ $stock->name }}, {{ $stock->discount }}%;&nbsp
                            @endif
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
    <div class="vspacer10px"></div>
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection