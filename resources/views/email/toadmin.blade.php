<div class="container">
    <div class="card">
        <div class="card-header">
            Оформлен новый заказ
        </div>
        <div class="card-body">
            <label>Пользователь: {{ $user->name }}</label><br>
            <label>id пользователя: {{ $user->id }}</label><br>
            <label>Заказ №: {{ $order->id }}</label><br>
            <label>Тип оплаты: {{ $order->payTypeRec->name }}</label><br>
            <label>Способ доставки: {{ $order->deliveryTypeRec->name }}<label><br>
            <label>Сумма: {{ $order->sumoforder }}</label>
        </div>
    </div>
</div>