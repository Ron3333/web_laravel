<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class BaseDatosController extends Controller
{
    public function index()
    {
        //ORM 
        //$post2 = Post::find(2);
        //dd($post2->title);

        //$post = Post::where('id', 2)->get();
        //dd($post[0]->title);

        //$post2 = Post::where('id', 2)->first();
        //dd($post2->title);
        
        // Query Builder

        //$post3 = DB::table('posts')->where('id', 2)->first();
        //dd($post3->title);

        //$post3 = DB::table('posts')->where('id', 2)->toSql();
        //echo $post3;
        /*
        $post_pages = Post::join('categories', 'categories.id', '=', 'posts.category_id')
                                ->select('posts.*', 'categories.title as categoryss')
                                ->orderBy('posts.created_at', 'desc')->get();

        dd($post_pages);

        foreach($post_pages as $post){
            echo $post->title . " ------> " . $post->categoryss . "<br>";
        }


        $post_sql = Post::join('categories', 'categories.id', '=', 'posts.category_id')
                                ->select('posts.*', 'categories.title as categoryss')
                                ->orderBy('posts.created_at', 'desc')->toSql();
        echo $post_sql;
       

         $post_pages2 = Post::join('categories', 'categories.id', '=', 'posts.category_id')
                                ->select('posts.*', 'categories.title as categoryss')
                                ->where('categories.id', 3)
                                ->orderBy('posts.created_at', 'desc')->get();

       foreach($post_pages2 as $post){
            echo $post->title . " ------> " . $post->categoryss . "<br>";
        }
         

        $posts3 = Post::join('categories', 'categories.id', '=', 'posts.category_id')
                 ->select('posts.*', 'categories.title as category', 'categories.slug as c_slug')
                 ->where('categories.slug', 'PEPE')
                 ->where('posted', "yes")
                 ->where(function ($query) {
                             $query->orWhere('type', 'post')
                            ->orWhere('type', 'courses')
                            ->orWhere('type', 'group');
                        })
            ->orderBy('posts.created_at', 'desc')
            ->toSql();

        echo $posts3;

     

        $ids = array(  3, 6, 8 );
        //$posts_in = Post::whereIn('posts.id',$ids)->get();
        $posts_in = Post::whereNotIn('posts.id',$ids)->get();
        //dd($posts_in);
        
        foreach($posts_in as $post){
            echo $post->id . " ------> " . $post->title . "<br>";
        }
            
        //$posts = Post::whereNotIn('posts.id',$ids);

        $ids = array(  3, 6, 8 );
        $posts_first = Post::whereIn('posts.id',$ids)->first();
        dd($posts_first->id);

        

        $posts_limit = Post::limit(2)->get();
        dd($posts_limit);

        

        $posts_offset = Post::limit(3)->offset(2)->get();
        
         foreach($posts_offset as $post){
            echo $post->id . " ------> " . $post->title . "<br>";
        }
      

        //$post_count = Post::limit(2)->offset(2)->get()->count();
        $post_count = Post::limit(2)->offset(2)->get()->count('posts.id');

        dd($post_count );
        

        $post_random = Post::where('id','<>',1)->inRandomOrder()->get();

        foreach($post_random as $post){
            echo $post->id . " ------> " . $post->title . "<br>";
        }

          

        $post_cat = Post::with('category')->get();

        foreach($post_cat as $post){
            echo $post->category->id . " ------> " .$post->category->title . "<br>";
        }

        echo "<hr>";

        $posts_perezosa = Post::all();
        foreach ($posts_perezosa as $p) {
            echo $p->category->id . " ------> " .$p->category->title . "<br>";
                //$categories = $p->categories; // Hace una consulta a la BD por cada post
        }


        $post_json = Post::find(2);
        $json = $post_json->toJson();
        return $json;
            */

         $posts_pluck = Post::all()->pluck('id', 'title' );
         dd($posts_pluck);

    }
}
