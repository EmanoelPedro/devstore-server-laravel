<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} -  {{$product->name}}</title>
</head>
<body>
    <header>

    </header>
    <main>
        <div>
            <h1>{{$product->name}}</h1>
        </div>
        <div>
            @foreach ($photos as $photo)
             <img src="{{$photo->url}}" alt="{{$photo->name}}"/>
            @endforeach
        </div>
        <div>
            <p>{{$product->description}}</p>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>