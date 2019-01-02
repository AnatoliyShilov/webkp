@extends('layouts.app')

@section('pageName', 'Корзина')

@section('contentSection')
    @if (count($basket) > 0)
        <a class="btn btn-primary" href={{ url('/userorders/create') }}>Заказать</a><br>
        <hr>
            <label>Сумма заказа: {{ $sumOfOrder }}</label>
        <hr>
        @foreach ($basket as $productInBasket)
            <div class="d-flex">
                <div class="card">
                    <div class="card-header">
                        <label>Товар: {{ $productInBasket['product'] }}</label>
                    </div>
                    <div class="card-body">
                        <label>Количество: {{ $productInBasket['count'] }}</label><br>
                        <label>Цена: {{ $productInBasket['cost'] }}</label><br>
                        <label>Сумма: {{ $productInBasket['count'] * $productInBasket['cost'] }}</label>
                    </div>
                </div>
                <div class="hspacer10px"></div>
                <form method="post" action={{ url('/basket/' . $productInBasket['product']) }}>
                    @csrf
                    @method('delete')
                    <button class="btn btn-primary" type='submit'>Убрать товар</button>
                </form>
            </div>
            <hr>
        @endforeach
    @else
        <label>Корзина пуста</label>
    @endif
@endsection