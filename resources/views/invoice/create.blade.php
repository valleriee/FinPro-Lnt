<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Invoice</title>
</head>
<body>
    <h1>Create Invoice</h1>

    @php
        $totalPrice = 0;
    @endphp

    <h2>Order Details:</h2>

    @foreach ($carts as $cart)
    @php
        $subTotal = $cart->product->price * $cart->quantity;
        $totalPrice += $subTotal;
    @endphp
        <li>{{$cart->product->name}}, price: {{$cart->product->price}}, quantity: {{ $cart->quantity}}, subtotal: {{$subTotal}}</li>
    @endforeach

    <br>
    <br>

    <form action="{{ route('invoice.store') }}" method=POST>
        @csrf
        <div>
            <label for="">Name:</label>
            <input type="text" name="name" value="{{Auth::user()->name}}">
        </div>

        <div>
            <label for="">Address:</label>
            <textarea name="address" cols="20" rows="6"></textarea>
        </div>

        <div>
            <label for="">Postal Code:</label>
            <input type="text" name="postal_code">
        </div>

        <div>
            <label for="">Total Price:</label>
            <input type="text" value="{{ $totalPrice }}" disabled>
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
        </div>

        <button>Submit</button>
    </form>
</body>
</html>