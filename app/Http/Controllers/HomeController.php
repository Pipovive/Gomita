<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categorias = Category::visible()
            ->ordenada()
            ->destacada()
            ->withCount('productosActivos')
            ->get();

        $destacados = Product::activo()
            ->destacado()
            ->with('categoria')
            ->orderByDesc('ventas_count')
            ->take(8)
            ->get();

        $nuevos = Product::activo()
            ->with('categoria')
            ->latest()
            ->take(8)
            ->get();

        $ofertas = Product::activo()
            ->conDescuento()
            ->with('categoria')
            ->take('4')
            ->get();

        return view('home.index',  compact(
            'categorias',
            'destacados',
            'nuevos',
            'ofertas'
        ));
    }
}
