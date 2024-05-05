<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Details</title>
</head>
<body>
    <h1>Detail Faktur {{$invoice->invoice_num}}</h1>

    <h2>Order Details:</h2>

    @foreach ($invoice->orders as $item)
    @php
        $subTotal = $item->product->price * $item->quantity;
    @endphp
        <li>{{$item->product->name}}, price: {{$item->product->price}}, quantity: {{ $item->quantity}}, subtotal: {{$subTotal}}</li>
    @endforeach

    <br>
    <br>

    <div>
        Name: {{$invoice->name}}
        <br>
        Address: {{$invoice->address}}
        <br>
        Postal Code: {{$invoice->postal_code}}
        <br>
        Total Price: {{$invoice->total_price}}
    </div>
</body>
</html>