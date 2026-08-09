<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\UserController;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\BaseDatosController;
use App\Http\Controllers\blog\BlogController;
use App\Http\Controllers\CourseController;

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
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('user', UserController::class);
  
    //  roles - permissions
    Route::post('role/assign/permission/{role}', [App\View\Components\Dashboard\role\permission\Manage::class, 'handle'])->name('role.assign.permission');
    Route::post('role/delete/permission/{role}', [App\View\Components\Dashboard\role\permission\Manage::class, 'delete'])->name('role.delete.permission');

});

Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function () {
       Route::get('', [BlogController::class, 'index'])->name('blog.index');
       Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
    });
});


Route::get('/blade', [CourseController::class, 'index']);


Route::get('/relacion', function () {
    /* Ejemplos de relacion uno es a uno */
    /*
    $user =  User::find(1);
    $perfil = $user->profile;
    $profile = Profile::find(1);
    $usuario = $profile->user;
    dd($usuario);
    */
    /* Ejemplo de las relacion uno es a muchos */

    //$categorias = Post::find(1)->category;
    //dd($categorias);
    //dd($categorias['title']);
    //$post = Category::find(1)->posts;
    //dd($post);

    /* Ejemplos de la relacion Muchos es Muchos */ 

    //$post_tags = Post::find(1)->tags;
    //dd($post_tags);
    //$tag_posts = Tag::find(2)->posts;
    //dd($tag_posts);
    //$post2 = Post::find(2);
    //$tag1 = Tag::find(1);
    //$tag2 = Tag::find(2);
    //$post2->tags()->attach($tag1);
    //$post2->tags()->detach($tag1);
    //$tag2->posts()->attach([3,4]);
    //$tag2->posts()->sync([3,4]);
    //$post2->tags()->sync([1,2]);


});