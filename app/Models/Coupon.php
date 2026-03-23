<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'descripcion',
        'tipo',
        'valor',
        'minimo_compra',
        'limite_usos',
        'usos_por_cliente',
        'usos_actuales',
        'category_id',
        'activo',
        'solo_primera_compra',
        'no_acumulable',
        'fecha_inicio',
        'fecha_vencimiento',
    ];

    protected $casts = [
        'valor'               => 'decimal:2',
        'minimo_compra'       => 'decimal:2',
        'activo'              => 'boolean',
        'solo_primera_compra' => 'boolean',
        'no_acumulable'       => 'boolean',
        'fecha_inicio'        => 'datetime',
        'fecha_vencimiento'   => 'datetime',
    ];

    // ═══════════════════════════════
    // RELACIONES
    // ═══════════════════════════════
    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // ═══════════════════════════════
    // SCOPES
    // ═══════════════════════════════
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    public function scopeVigente($query)
    {
        return $query->where('activo', true)
            ->where(function ($q) {
                $q->whereNull('fecha_inicio')
                    ->orWhere('fecha_inicio', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('fecha_vencimiento')
                    ->orWhere('fecha_vencimiento', '>=', now());
            });
    }

    // ═══════════════════════════════
    // MÉTODOS DE VALIDACIÓN
    // $coupon->esValido($subtotal, $user)
    // $coupon->calcularDescuento($subtotal)
    // ═══════════════════════════════
    public function esValido(float $subtotal, User $user): array
    {
        // está activo y vigente
        if (!$this->activo) {
            return ['valido' => false, 'mensaje' => 'Este cupón no está activo.'];
        }

        // fecha de inicio
        if ($this->fecha_inicio && now()->lt($this->fecha_inicio)) {
            return ['valido' => false, 'mensaje' => 'Este cupón todavía no está disponible.'];
        }

        // fecha de vencimiento
        if ($this->fecha_vencimiento && now()->gt($this->fecha_vencimiento)) {
            return ['valido' => false, 'mensaje' => 'Este cupón ya venció.'];
        }

        // límite de usos global
        if ($this->limite_usos && $this->usos_actuales >= $this->limite_usos) {
            return ['valido' => false, 'mensaje' => 'Este cupón ya alcanzó su límite de usos.'];
        }

        // mínimo de compra
        if ($subtotal < $this->minimo_compra) {
            return ['valido' => false, 'mensaje' => "El mínimo de compra es \${$this->minimo_compra}."];
        }

        // usos por cliente
        $usosDelCliente = Order::completado()
            ->where('user_id', $user->id)
            ->where('coupon_id', $this->id)
            ->count();

        if ($usosDelCliente >= $this->usos_por_cliente) {
            return ['valido' => false, 'mensaje' => 'Ya usaste este cupón el máximo de veces permitido.'];
        }

        // solo primera compra
        if ($this->solo_primera_compra) {
            $tieneCompras = Order::completado()
                ->where('user_id', $user->id)
                ->exists();

            if ($tieneCompras) {
                return ['valido' => false, 'mensaje' => 'Este cupón es solo para primera compra.'];
            }
        }

        return ['valido' => true, 'mensaje' => '✅ Cupón aplicado correctamente.'];
    }

    public function calcularDescuento(float $subtotal): float
    {
        if ($this->tipo === 'porcentaje') {
            return round($subtotal * ($this->valor / 100), 2);
        }

        // monto fijo — no puede ser mayor al subtotal
        return min($this->valor, $subtotal);
    }

    // ═══════════════════════════════
    // ACCESSORS
    // ═══════════════════════════════
    public function getEstaVigentAttribute(): bool
    {
        if (!$this->activo) return false;
        if ($this->fecha_inicio && now()->lt($this->fecha_inicio)) return false;
        if ($this->fecha_vencimiento && now()->gt($this->fecha_vencimiento)) return false;
        if ($this->limite_usos && $this->usos_actuales >= $this->limite_usos) return false;
        return true;
    }

    public function getDescuentoLabelAttribute(): string
    {
        return $this->tipo === 'porcentaje'
            ? "{$this->valor}% OFF"
            : "$" . number_format($this->valor, 2) . " OFF";
    }

    public function getUsosRestantesAttribute(): ?int
    {
        if (!$this->limite_usos) return null;
        return max(0, $this->limite_usos - $this->usos_actuales);
    }
}
