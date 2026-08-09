@extends('dashboard.layout')

@section('content')
    <h1>{{ $user->name }}</h1>
    <ul>
        <li>{{ $user->email }}</li>
    </ul>   

    <h6>**************** Componente de Gestión de Roles y Permisos ************************</h6>
     {{-- Solo mostrar la gestión de roles/permisos si el usuario tiene permiso de actualizar --}}
    <x-dashboard.user.role.permission.manage :user="$user" />
    

@endsection