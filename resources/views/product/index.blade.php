@extends('layouts.app')

@isset($typeName)
    @section('pageName', 'Товары категории ' . $typeName)
@else
    @section('pageName', 'Товары')
@endisset

@section('contentSection')
    @if(Auth::user()->role == 0)
        <div class="vspacer10px"></div>
        <a class="btn btn-primary" href={{ url('/products/create') }}>Создать</a>
        <div class="vspacer10px"></div>
    @endif
    <hr>
    @foreach ($products as $product)
        <p>
            <div class="d-flex">
                <a class="btn btn-primary" href={{ url('/products/' . $product->id) }}>{{$product->name}}</a>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/tobasket/' . $product->id) }}>
                    @csrf
                    <button class="btn btn-primary" type="submit">Заказать</button>
                </form>
                @if (Auth::user()->role == 0)
                    <div class="hspacer10px"></div>
                    <a class="btn btn-primary" href={{ url('/products/' . $product->id . '/edit') }}>Редактировать</a>
                    <div class="hspacer10px"></div>
                    <form method="post" action={{ url('/products/' . $product->id) }}>
                        @csrf
                        @method('delete')
                        <button class="btn btn-primary" type="submit">Удалить</button>
                    </form>
                @endif
            </div>
        </p>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div>
@endsection