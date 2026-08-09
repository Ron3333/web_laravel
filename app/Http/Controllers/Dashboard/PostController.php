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
        //dd(Auth::user());
        /*
        if(Auth::user()->hasPermissionTo('editor.post.update')){
            echo "No tienes permiso para actualizar los posts";
        }
            */
         //$posts = Post::get();

        $posts = Post::paginate(4);
        if (!Gate::allows('index', $posts[0])) {
            abort(403);
        }
         //dd($posts);
         return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        //dd($request->all());
        //Post::create($request->all());
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
        //dd($id);
        //$post = Post::find($id);
        //dd($post);
        return view('dashboard.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    { 
        /*
       if (!Gate::allows('update', $post)) {
            return abort(403);
        }
        */

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
       /* 
       if (!Gate::allows('update', $post)) {
            return abort(403);
        }
       */

        $res = Gate::inspect('update', $post);
        if (!$res->allowed()) {
            return abort(403, $res->message());
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
        if (!Gate::allows('delete', $post)) {
            return abort(403);
        }

        $post->delete();
        return to_route("post.index")->with('status', 'Post eliminado');
    }

    public function pepe(){
        echo "Soy PEPE";
    }
}
