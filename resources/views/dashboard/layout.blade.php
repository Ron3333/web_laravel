<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
         @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/estilo.css'])
</head>
<body>
     <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Cerrar Sesión
        </button>
    </form>
    <form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">
         Dashboard
        </button>
    </form>
    <br>
    @auth
        <p>Bienvenido, <b>{{ auth()->user()->name }}</b></p>
    @endauth
    <br>
    @if (session('status'))
        {{ session('status') }}
    @endif
    
    @yield('content')
    <hr>
    <div>
        @yield('contenido2')
    </div>
</body>
</html>