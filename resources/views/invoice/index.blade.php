<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Your Order Lists</h1>

    @foreach ($invoices as $invoice)
        <li>{{$invoice->invoice_num}}, Total harga: {{$invoice->total_price}}</li>
        <a href="{{ route('invoice.show', $invoice->invoice_num) }}">Cetak Faktur</a>
    @endforeach
</body>
</html>