@extends('blog.layout')
@section('content')
    <x-blog.post.index :posts="$posts">  
       Post / Articulo 
       @slot('header')
            Header 1
        @endslot
        @slot('extra')
            Extra 1
        @endslot
    </x-blog.post.index >
@endsection
