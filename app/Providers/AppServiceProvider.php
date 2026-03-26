<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Style;
use App\Models\ProductType;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ═══════════════════════════════════════════════
        // VIEW COMPOSER DEL HEADER
        // Un solo composer que pasa TODAS las variables
        // que el header necesita. Se ejecuta cada vez que
        // Laravel renderiza partials/header.blade.php
        // ═══════════════════════════════════════════════
        View::composer('partials.header', function ($view) {

            // Categorías para el dropdown del menú
            $view->with(
                'categorias',
                Category::visible()->ordenada()->get()
            );

            // Estilos para el dropdown de estilos
            $view->with(
                'estilos',
                Style::visible()->ordenado()->get()
            );

            // Tipos de producto para el dropdown correspondiente
            $view->with(
                'tipos',
                ProductType::where('estado', true)->get()
            );

            // Cantidad de items en el carrito para el badge
            // session('cart', []) devuelve el carrito o array vacío si no existe
            // array_sum suma todas las cantidades de cada producto
            $view->with(
                'cartCount',
                array_sum(session('cart', []))
            );
        });

        // ═══════════════════════════════════════════════
        // PAGINACIÓN
        // Le dice a Laravel qué vista usar para renderizar
        // los links de paginación en todas las páginas
        // ═══════════════════════════════════════════════
        Paginator::defaultView('vendor.pagination.custom');
    }
}
