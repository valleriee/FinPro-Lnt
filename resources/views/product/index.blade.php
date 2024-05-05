<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chipi Chapa Product</title>
</head>
<body>
    <h1>Product List</h1>
    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }}, Rp {{ $product->price}}, {{$product->stock}}</li>
            <a href="{{ route('product.show', $product->slug) }}">Show</a>
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
        @endforeach
    </ul>
    
</body>
</html>