<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'nombre_producto',
        'precio_unitario',
        'cantidad',
        'subtotal',
    ];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal'        => 'decimal:2',
        'cantidad'        => 'integer',
    ];

    // ═══════════════════════════════
    // RELACIONES
    // ═══════════════════════════════
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function download()
    {
        return $this->hasOne(Download::class);
    }

    // ═══════════════════════════════
    // ACCESSORS
    // $item->tiene_descarga
    // ═══════════════════════════════
    public function getTieneDescargaAttribute(): bool
    {
        return $this->download()->exists();
    }
}
