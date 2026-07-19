<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
        $id =  $request->route('id');
        //dd($id);
        if($id == 50){
            return $next($request);
        }else{
            return redirect("/");
        }
       
    }
}
