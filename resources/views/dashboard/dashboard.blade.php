<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Dashboard</h1>
    <p>Welcome to your dashboard!</p>

    @auth
        <p>Bienvenido, <b>{{ auth()->user()->name }}</b></p>
    @endauth
        <ul>
            <li><a href="{{ route('post.index') }}">Ver Post</a></li>
            <li><a href="{{ route('category.index') }}">Ver Categoria</a></li>
        </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Cerrar Sesión
        </button>
    </form>
    
</body>
</html>