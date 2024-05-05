<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Product</title>
</head>
<body>
    <h1>Create New Product</h1>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="">Product Name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="">Price</label>
            <input type="number" name="price">
        </div>
        <div>
            <label for="">Stock</label>
            <input type="number" name="stock">
        </div>
        <div>
            <label for="image">Insert Image</label>
            <input type="file" name="image">
        </div>
        
        <div>
            <label for="">Category</label>
            <input type="text" name="category">
        </div>
        <button>Submit</button>
    </form>
</body>
</html>