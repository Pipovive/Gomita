<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_orden',
        'user_id',
        'coupon_id',
        'subtotal',
        'descuento',
        'total',
        'estado',
        'metodo_pago',
        'mp_payment_id',
        'mp_status',
        'pagado_en',
        'notas',
    ];

    protected $casts = [
        'subtotal'   => 'decimal:2',
        'descuento'  => 'decimal:2',
        'total'      => 'decimal:2',
        'pagado_en'  => 'datetime',
    ];

    // ═══════════════════════════════
    // BOOT
    // genera número de orden automático
    // ej: ORD-2025-00124
    // ═══════════════════════════════
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($order) {
            $ultimo = static::max('id') ?? 0;
            $order->numero_orden = 'ORD-' . date('Y') . '-' . str_pad($ultimo + 1, 5, '0', STR_PAD_LEFT);
        });
    }

    // ═══════════════════════════════
    // RELACIONES
    // ═══════════════════════════════
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function downloads()
    {
        return $this->hasManyThrough(
            Download::class,
            OrderItem::class
        );
    }

    // ═══════════════════════════════
    // SCOPES
    // Order::completado()->get()
    // Order::pendiente()->get()
    // ═══════════════════════════════
    public function scopeCompletado($query)
    {
        return $query->where('estado', 'completado');
    }

    public function scopePendiente($query)
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeDelUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ═══════════════════════════════
    // ACCESSORS
    // $order->estado_label
    // $order->esta_pagado
    // ═══════════════════════════════
    public function getEstaPagedoAttribute(): bool
    {
        return $this->estado === 'completado';
    }

    public function getEstadoLabelAttribute(): string
    {
        return match ($this->estado) {
            'pendiente'    => '⏳ Pendiente',
            'procesando'   => '🔄 Procesando',
            'completado'   => '✅ Completado',
            'fallido'      => '❌ Fallido',
            'reembolsado'  => '↩️ Reembolsado',
            default        => $this->estado,
        };
    }

    public function getMetodoPagoLabelAttribute(): string
    {
        return match ($this->metodo_pago) {
            'tarjeta'     => '💳 Tarjeta',
            'pse'         => '🏦 PSE',
            'nequi'       => '📱 Nequi',
            'efecty'      => '💵 Efecty',
            'mercadopago' => '💙 MercadoPago',
            default       => $this->metodo_pago ?? '—',
        };
    }
}
