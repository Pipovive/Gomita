<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Style;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::activo()->with('categoria');
        //filtro categoria

        if ($request->filled('categoria')) {
            $query->enCategoria($request->categoria);
        }

        // filtro precio

        if ($request->filled('precio')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->precio as $rango) {
                    match ($rango) {
                        'gratis' => $q->orWhere('precio', 0),
                        'menos5' => $q->orWhere('precio', '<', '5'),
                        '5a10' => $q->orWhereBetween('precio', [5, 10]),
                        'mas10' => $q->orWhere('precio', '>', 10),
                        default => null
                    };
                }
            });
        }

        // búsqueda

        if ($request->filled('q')) {
            $query->buscar($request->q);
        }

        //orden

        if ($request->filled('orden')) {
            match ($request->orden) {
                'precio_asc' => $query->orderBy('precio'),
                'precio_desc' => $query->orderByDesc('precio'),
                'mas_vendidos' => $query->orderByDesc('ventas_count'),
                'novedades' => $query->latest(),
                default => $query->orderByDesc('ventas_count'),
            };
        }


        //tipo
        if ($request->filled('tipo')) {
            $query->delTipo($request->tipo); // viene como string desde el header
        }
        //estilo

        if ($request->filled('estilo')) {
            $query->whereHas('estilo', function ($q) use ($request) {
                $q->where('slug', $request->estilo);
            });
        }


        // ── Filtro por TIPO DE ARCHIVO (pdf, canva, pptx...) desde el sidebar
        if ($request->filled('formato')) {
            $formatos = (array) $request->formato; // puede venir como array desde checkboxes
            $query->where(function ($q) use ($formatos) {
                foreach ($formatos as $formato) {
                    $q->orWhere('tipo_archivo', 'LIKE', "%{$formato}%");
                }
            });
        }

        // ProductController@index
        if ($request->filled('modalidad')) {
            $query->modalidad($request->modalidad);
        }

        $productos = $query->paginate(12);
        $categorias = Category::visible()->ordenada()->get();
        $estilos = Style::orderBy('orden')->get();

        return view('products.index', compact('productos', 'categorias', 'estilos'));
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

    // ProductController.php
    public function digitales()
    {
        $productos = Product::activo()
            ->digital()
            ->with('categoria')
            ->paginate(12);

        return view('products.digitales', compact('productos'));
    }

    public function lanzarote()
    {
        $productos = Product::activo()
            ->fisico()
            ->with('categoria')
            ->paginate(12);

        return view('products.lanzarote', compact('productos'));
    }
    public function show(string $slug)
    {
        $producto = Product::activo()
            ->with('categoria')
            ->where('slug', $slug)
            ->firstOrFail();

        $relacionados = Product::activo()
            ->where('category_id', $producto->category_id)
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
