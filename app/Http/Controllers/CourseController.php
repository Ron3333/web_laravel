<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        return view('pruebas.dashboard', [
            'user' => 'Ronald Melendez',
            'role' => 'editor',
            'email' => 'editor@email.com',
            'age' => '',
            'status' => 1, // 1: Pendiente, 2: Activo, 3: Suspendido
            'courses' => [
                ['id' => 1, 'name' => 'Laravel 13', 'type' => 'Backend', 'premium' => true],
                ['id' => 2, 'name' => 'Vue.js 3', 'type' => 'Frontend', 'premium' => false],
                ['id' => 3, 'name' => 'AWS Cloud', 'type' => 'DevOps', 'premium' => true],
                ['id' => 4, 'name' => 'Cloud ', 'type' => 'DevOps', 'premium' => true],
                ['id' => 5, 'name' => 'JavaScript', 'type' => 'Frontend', 'premium' => false],
            ],
            'tags' => ['uno, dos', 'tres'], // Array vacío para probar @forelse
            'isSubscribed' => true,
        ]);
    }
    
}
