<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Mi nombre es {{$name}}</h1>
    <br>
    @if($name == "pepe")
        Si soy Pepe
    @else
        No soy pepe
    @endif
</body>
</html>