<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    echo "Esto es un TEST";
});

Route::get('/test2/{id?}', function ($id = 50) {
    echo "Esto es un TEST con ID ". $id;
});

Route::get('/prueba', function(){
    return view('test', ['id'=> 20]);
});

Route::get('/prueba3/{name?}', function($name="anonimo"){
    return view('prueba', ['name'=> $name]);
})->name('prueba2');

 Route::get('/test-1', [TestController::class, 'index']);
 Route::get('/test-2', [TestController::class, 'vista']);

 Route::resource('post', PostController::class);
 Route::resource('category', CategoryController::class);
