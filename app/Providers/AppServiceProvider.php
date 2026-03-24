<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ═══ HEADER ═══
        // $categorias disponible en el header de todas las páginas
        View::composer('partials.header', function ($view) {
            $view->with(
                'categorias',
                Category::visible()->ordenada()->get()
            );
        });

        // ═══ CARRITO ═══
        // el badge del carrito se actualiza en todas las páginas
        View::composer('partials.header', function ($view) {
            $view->with(
                'cartCount',
                array_sum(session('cart', []))
            );
        });
    }
}
