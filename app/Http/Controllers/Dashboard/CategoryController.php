<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('editor.category.index')) {
            abort(403, 'No tienes permiso para ver las categorías');
        }

        $categories = Category::paginate(2);
        //dd($categories);
        return view('dashboard/category/index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if (!Auth::user()->hasPermissionTo('editor.category.create')) {
            abort(403, 'No tienes permiso para crear categorías');
        }

        $category = new Category();
        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
         if (!Auth::user()->hasPermissionTo('editor.category.create')) {
            abort(403, 'No tienes permiso para crear categorías');
        }
        Category::create($request->validated());
        return to_route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if (!Auth::user()->hasPermissionTo('editor.category.index')) {
            abort(403, 'No tienes permiso para ver las categorías');
        }
        return view('dashboard/category/show',['category'=> $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
         if (!Auth::user()->hasPermissionTo('editor.category.update')) {
            abort(403, 'No tienes permiso para editar categorías');
        }
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
         if (!Auth::user()->hasPermissionTo('editor.category.update')) {
            abort(403, 'No tienes permiso para editar categorías');
        }
        $category->update($request->validated());
        return to_route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!Auth::user()->hasPermissionTo('editor.category.destroy')) {
            abort(403, 'No tienes permiso para eliminar categorías');
        }
       $category->delete();
        return to_route('category.index');
    }
}
