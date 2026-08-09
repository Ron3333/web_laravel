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

    @auth
        @if(auth()->user()->hasPermissionTo('editor.post.update'))
            <h5>Puede editar Posts</h5>
        @else
            <h5>No tiene permiso editor.post.update</h5>
        @endif
    @endauth

    @can('editor.post.update')
         <h5>PUEDES EDITAR EL POST </h5>
    @endcan
   
        <ul>
            <li><a href="{{ route('post.index') }}">Ver Post</a></li>
            <li><a href="{{ route('category.index') }}">Ver Categoria</a></li>
            <li><a href="{{ route('role.index') }}">Ver Roles</a></li>
            <li><a href="{{ route('permission.index') }}">Ver Permisos</a></li>
            @if(auth()->user()->hasRole('Admin'))
                <li><a href="{{ route('user.index') }}">Ver Usuarios</a></li>
             @endif
        </ul>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Cerrar Sesión
        </button>
    </form>
    
</body>
</html>