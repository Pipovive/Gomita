<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::activo()->with('categoria');

        if ($request->filled('tipo')) {
            $query->enCategoria($request->categoria);
        }

        if ($request->filled('tipo')) {
            $query->where('tipo_archivo', 'LIKE', "%{request->tipo}%");
        }

        if ($request->filled('q')) {
            $query->buscar($request->q);
        }

        if ($request->filled('orden')) {
            match ($request->orden) {
                'precio_asc' => $query->orderBy('precio'),
                'precio_desc' => $query->orderByDesc('precio'),
                'mas_vendidos' => $query->orderByDesc('ventas_count'),
                'novedades' => $query->latest(),
                default => $query->orderByDesc('ventas_count'),
            };
        }

        //
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
        $producto = Product::activo()
            ->with('categoria')
            ->where('slug', $slug)
            ->firstOrFail();

        $relacionados = Product::activo()
            ->where('category_id', $producto->categoey_id)
            ->where('id', '!=', $producto->id)
            ->take(4)
            ->get();

        return view('products.show', compact('producto', 'relacionados'));
    }

    public function ofertas()
    {
        $productos = Product::activo()
            ->conDescuento()
            ->with('categoria')
            ->paginate(12);

        return view('products.ofertas', compact('productos'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
