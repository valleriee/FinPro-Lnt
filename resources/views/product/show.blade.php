<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Product Detail</title>
</head>
<body>
    <h1>{{$product->name}}</h1>
    <p>
        product price: {{$product->price}}
        <br>
        product stock: {{$product->stock}}
        <br>
        <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}">
        <br>
        category: {{$product->category->category_name}}
        <br>

        <h2>Add Product to Cart</h2>
        <form action="{{ route('cart.store') }}" method=POST>
            @csrf
            {{-- hidden id product --}}
            <input type="hidden" name="product_id" value="{{$product->id}}">
            {{-- input quantity --}}
            <input type="number" name="quantity">

            <button>Add to Cart</button>
        </form>
        
    </p>
</body>
</html>