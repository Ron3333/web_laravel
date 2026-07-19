<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Models\Post;
use App\Http\Controllers\BaseDatosController;
use App\Http\Controllers\blog\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/base-datos', [BaseDatosController::class, 'index']);

Route::middleware([App\Http\Middleware\TestMiddleware::class])->group(function () {
    Route::get('/control/{id}', function (int $id) {
            echo $id;
    });
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

 //Route::resource('post', PostController::class);
 //Route::resource('category', CategoryController::class);

 Route::group(['prefix' => 'dashboard', 'middleware'=> ['auth',App\Http\Middleware\UserIsAdminMiddleware::class]], function () {

    Route::get('/', function(){
        return view('dashboard.dashboard');
    })->name("dashboard");

    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
   //Route::get('/pepe2', [PostController::class, 'pepe']);
});

Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function () {
       Route::get('', [BlogController::class, 'index'])->name('blog.index');
       Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
    });
});
