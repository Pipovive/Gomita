<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Category::visible()
            ->ordenada()
            ->withCount('productosActivos')
            ->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $categoria = Category::where('slug', $slug)
            ->visible()
            ->firstOrFail();
        $productos = Product::activo()
            ->enCategoria($slug)
            ->with('categoria')
            ->paginate(12);
        $categorias = Category::visible()->ordenada()->get();
        $estilos = Style::orderBy('orden')->get();

        return view('categorias.show', compact('categoria', 'categorias', 'productos', 'estilos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
