<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id',
        'user_id',
        'product_id',
        'token',
        'descargas_realizadas',
        'max_descargas',
        'expira_en',
        'primera_descarga_en',
        'ultima_descarga_en',
        'ip_ultima_descarga',
    ];

    protected $casts = [
        'expira_en'            => 'datetime',
        'primera_descarga_en'  => 'datetime',
        'ultima_descarga_en'   => 'datetime',
        'descargas_realizadas' => 'integer',
        'max_descargas'        => 'integer',
    ];

    // ═══════════════════════════════
    // BOOT
    // genera token único automático
    // ═══════════════════════════════
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($download) {
            $download->token = Str::random(64);
        });
    }

    // ═══════════════════════════════
    // RELACIONES
    // ═══════════════════════════════
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ═══════════════════════════════
    // MÉTODOS
    // ═══════════════════════════════
    public function estaDisponible(): bool
    {
        // verificar que no expiró
        if ($this->expira_en && now()->gt($this->expira_en)) {
            return false;
        }

        // verificar que no superó el máximo de descargas
        if ($this->descargas_realizadas >= $this->max_descargas) {
            return false;
        }

        return true;
    }

    public function registrarDescarga(string $ip): void
    {
        $ahora = now();

        $this->update([
            'descargas_realizadas'  => $this->descargas_realizadas + 1,
            'ultima_descarga_en'    => $ahora,
            'ip_ultima_descarga'    => $ip,
            'primera_descarga_en'   => $this->primera_descarga_en ?? $ahora,
        ]);
    }

    // ═══════════════════════════════
    // SCOPES
    // ═══════════════════════════════
    public function scopeDisponible($query)
    {
        return $query->where('descargas_realizadas', '<', $query->getModel()->getTable() . '.max_descargas')
            ->where(function ($q) {
                $q->whereNull('expira_en')
                    ->orWhere('expira_en', '>', now());
            });
    }

    public function scopeDelUsuario($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ═══════════════════════════════
    // ACCESSORS
    // ═══════════════════════════════
    public function getDescargasRestantesAttribute(): int
    {
        return max(0, $this->max_descargas - $this->descargas_realizadas);
    }

    public function getEstaExpiradoAttribute(): bool
    {
        return $this->expira_en && now()->gt($this->expira_en);
    }

    public function getLinkDescargaAttribute(): string
    {
        return route('descargas.show', $this->token);
    }
}
