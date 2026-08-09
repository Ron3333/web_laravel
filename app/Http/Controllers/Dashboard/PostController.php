<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\PutRequest;
use Pest\Support\View;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        if (!Auth::user()->hasPermissionTo('editor.post.index')) {
            abort(403, 'No tienes permiso para ver los posts');
        }

        $posts = Post::paginate(4);
       
         return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if (!Auth::user()->hasPermissionTo('editor.post.create')) {
            abort(403, 'No tienes permiso para crear posts');
        }
        $categories = Category::pluck('id', 'title');
         //dd($categories);
        $post = new Post();
        return view('dashboard.post.create', compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest  $request)
    {
        if (!Auth::user()->hasPermissionTo('editor.post.create')) {
            abort(403, 'No tienes permiso para crear posts');
        }

        $post = new Post($request->validated());
        $user = Auth::user();
        //dd($user->name);
        $user->posts()->save($post);

        return to_route("post.index")->with('status', 'Post creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (!Auth::user()->hasPermissionTo('editor.post.index')) {
            abort(403, 'No tienes permiso para ver posts');
        }
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    { 
       if (!Auth::user()->hasPermissionTo('editor.post.update')) {
            abort(403, 'No tienes permiso para editar posts');
        }

        $res = Gate::inspect('update', $post);
        if (!$res->allowed()) {
            return abort(403, $res->message());
        }


        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        if (!Auth::user()->hasPermissionTo('editor.post.update')) {
            abort(403, 'No tienes permiso para editar posts');
        }

      

        $data = $request->validated();
        if( isset($data["image"])){
            $data["image"] = time().".".$data["image"]->extension();
            $request->image->move(public_path("image"), $data["image"] );
        }
        $post->update($data);
        return to_route("post.index")->with('status', 'Post actualizado');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!Auth::user()->hasPermissionTo('editor.post.destroy')) {
            abort(403, 'No tienes permiso para eliminar posts');
        }

        $post->delete();
        return to_route("post.index")->with('status', 'Post eliminado');
    }

    public function pepe(){
        echo "Soy PEPE";
    }
}
