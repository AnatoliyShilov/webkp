@extends('layouts/show')

@section('pageName', 'Show user order ' . $userOrder->id)

@section('btnsEditDelete')
@endsection

@section('displayFields')
    <div class="card">
        <div class="card-header">
            <label>Номер заказа: {{ $userOrder->id }}</label><br>
        </div>
        <div class="card-body">
            <label>Адрес: {{ $userOrder->address }}</label><br>
            <label>Способ доставки: {{ $userOrder->deliveryTypeRec->name }}</label><br>
            <label>Способ оплаты: {{ $userOrder->payTypeRec->name }}</label><br>
            <label>Пользователь: {{ $userOrder->userRec->name }}</label><br>
            <label>Сумма: {{ $sumOfOrder }}</label><br>
        </div>
    </div>
    <hr>
    @foreach ($productLists as $productList)
        <label>Товар: <a class="btn btn-primary" href={{ url('/products/' . $productList->product) }}>{{ $productList->productRec->name }}</a></label><br>
        <label>Количество: {{ $productList->count }}</label><br>
        <label>Цена: {{ $productList->productRec->cost }}</label><br>
        <label>Сумма: {{ $productList->count * $productList->productRec->cost }}</label><br>
        <hr>
    @endforeach
    <div class="d-flex justify-content-center">
        {{ $productLists->links() }}
    </div>
@endsection