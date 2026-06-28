<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function index(){
        echo "Hola estoy en el controlador Test"; 
    }

    function vista(){
         return view('prueba', ['name'=> "Tomas"]);
    }
}
