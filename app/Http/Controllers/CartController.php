<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // carrito vive en sesión: session('cart') = [ product_id => cantidad ]

    public function index()
    {
        $items    = $this->obtenerItems();
        $subtotal = $items->sum(fn($i) => $i['producto']->precio * $i['cantidad']);
        $cupon    = session('cupon');
        $descuento = 0;

        if ($cupon) {
            $couponModel = Coupon::where('codigo', $cupon['codigo'])->first();
            $descuento   = $couponModel?->calcularDescuento($subtotal) ?? 0;
        }

        $total = max(0, $subtotal - $descuento);

        return view('cart.index', compact('items', 'subtotal', 'descuento', 'cupon', 'total'));
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'cantidad'   => 'integer|min:1|max:10',
        ]);

        $cart      = session('cart', []);
        $id        = $request->product_id;
        $cantidad  = $request->cantidad ?? 1;

        $cart[$id] = ($cart[$id] ?? 0) + $cantidad;
        session(['cart' => $cart]);

        return response()->json([
            'mensaje'    => '¡Agregado al carrito!',
            'cart_count' => array_sum($cart),
        ]);
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate(['cantidad' => 'required|integer|min:1|max:10']);

        $cart     = session('cart', []);
        $cart[$id] = $request->cantidad;
        session(['cart' => $cart]);

        return response()->json(['ok' => true]);
    }

    public function eliminar($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);

        return response()->json(['ok' => true]);
    }

    public function aplicarCupon(Request $request)
    {
        $request->validate(['codigo' => 'required|string']);

        $cupon = Coupon::vigente()
            ->where('codigo', strtoupper($request->codigo))
            ->first();

        if (!$cupon) {
            return response()->json([
                'ok'      => false,
                'mensaje' => 'Cupón inválido o vencido.',
            ]);
        }

        session(['cupon' => [
            'codigo' => $cupon->codigo,
            'tipo'   => $cupon->tipo,
            'valor'  => $cupon->valor,
            'label'  => $cupon->descuento_label,
        ]]);

        return response()->json([
            'ok'      => true,
            'mensaje' => '✅ ' . $cupon->descripcion,
            'label'   => $cupon->descuento_label,
        ]);
    }

    // ═══ HELPER PRIVADO ═══
    private function obtenerItems(): \Illuminate\Support\Collection
    {
        $cart = session('cart', []);

        if (empty($cart)) return collect();

        $productos = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        return collect($cart)->map(function ($cantidad, $id) use ($productos) {
            $producto = $productos->get($id);
            if (!$producto) return null;

            return [
                'producto' => $producto,
                'cantidad' => $cantidad,
                'subtotal' => $producto->precio * $cantidad,
            ];
        })->filter();
    }
}
