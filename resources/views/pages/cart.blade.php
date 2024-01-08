<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Cart - GeekStore</title>
</head>
<body>
    <form action="{{route('products.addToCard')}}" method="post">
        @csrf
        <label for="product_id">Product Id</label>
        <input type="number" id="product_id" name="product_id" placeholder="product id">
        <button type="submit">Add to Card</button>
    </form>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>