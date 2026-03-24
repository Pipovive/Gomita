<?php

use Illuminate\Support\Facades\Route;

// Frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PerfilController;

// Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CouponController;

//ROUTE PÚBLUCAS

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categorias', [CategoryController::class, 'index'])->name('categorias.index');
Route::get('/categorias/{slug}', [CategoryController::class, 'show'])->name('categorias.show');
Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
Route::get('/productos/{slug}', [ProductController::class, 'show'])->name('productos.show');
Route::get('/contacto', fn() => view('contacto'))->name('contacto');
Route::get('/ofertas', [ProductController::class, 'ofertas'])->name('ofertas');

//ROUTE CARRITOS (SIN LOGIN)

Route::prefix('carrito')->name('carrito.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/agregar', [CartController::class, 'agregar'])->name('agregar');
    Route::patch('/actualizar/{id}', [CartController::class, 'actualizar'])->name('actualizar');
    Route::delete('/eliminar/{id}', [CartController::class, 'eliminar'])->name('eliminar');
    Route::post('/cupon', [CartController::class, 'aplicarCupon'])->name('cupon');
});


//REQUIERE LOGIN
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/perfil', [PerfilController::class, 'index'])->name('perfil.index');
    Route::get('/perfil', [PerfilController::class, 'update'])->name('perfil.update');

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/procesar', [CheckoutController::class, 'procesar'])->name('procesar');
        Route::get('/confirmacion/{orden}', [CheckoutController::class, 'confirmacion'])->name('confirmacion');
    });

    Route::get('/descargas/{token}', [DownloadController::class, 'show'])->name('descargas.show');
    Route::get('/mis-pedidos', [PerfilController::class, 'pedidos'])->name('perfil.pedidos');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('productos', AdminProductController::class);
    Route::resource('categorias', AdminCategoryController::class);
    Route::resource('cupones', CouponController::class);
    Route::resource('pedidos', AdminOrderController::class)->only(['index', 'show', 'update']);
});

require __DIR__ . '/auth.php';
