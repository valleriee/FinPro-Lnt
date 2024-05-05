<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
</head>
<body>
    <h1>Cart</h1>

    @php
        $totalPrice = 0;
    @endphp

    @foreach ($carts as $cart)
    @php
        $subTotal = $cart->product->price * $cart->quantity;
        $totalPrice += $subTotal;
    @endphp
        <li>{{$cart->product->name}}, price: {{$cart->product->price}}, quantity: {{ $cart->quantity}}, subtotal: {{$subTotal}}</li>
    @endforeach

    <div>
        <p>total price: {{$totalPrice}}</p>
        <a href="{{ route('invoice.create') }}">Checkout</a>
    </div>
</body>
</html>