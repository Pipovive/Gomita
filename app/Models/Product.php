<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model implements HasMedia
{
    use HasFactory,
        SoftDeletes,
        HasSlug,
        InteractsWithMedia,
        LogsActivity;

    protected $fillable = [
        'category_id',
        'nombre',
        'slug',
        'descripcion',
        'precio',
        'precio_original',
        'tipo_archivo',
        'badge',
        'estado',
        'descarga_inmediata',
        'destacado',
        'permite_resenas',
        'tags',
        'ventas_count',
        'rating_promedio',
        'resenas_count',
        'archivo_path',
    ];

    protected $casts = [
        'precio'             => 'decimal:2',
        'precio_original'    => 'decimal:2',
        'rating_promedio'    => 'decimal:2',
        'descarga_inmediata' => 'boolean',
        'destacado'          => 'boolean',
        'permite_resenas'    => 'boolean',
        'tags'               => 'array',
        // convierte el JSON a array automáticamente
    ];

    // ═══════════════════════════════
    // SLUG AUTOMÁTICO
    // ═══════════════════════════════
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(80);
    }

    // ═══════════════════════════════
    // ACTIVITY LOG
    // registra cambios en el admin
    // ═══════════════════════════════
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nombre', 'precio', 'estado', 'destacado'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) =>
                "Producto {$eventName}: {$this->nombre}"
            );
    }

    // ═══════════════════════════════
    // MEDIA
    // ═══════════════════════════════
    public function registerMediaCollections(): void
    {
        // imagen principal del producto
        $this->addMediaCollection('imagen')
             ->singleFile();

        // galería de imágenes adicionales
        $this->addMediaCollection('galeria');
    }

    public function registerMediaConversions($media = null): void
    {
        // genera thumbnails automáticamente al subir imagen
        $this->addMediaConversion('thumb')
             ->width(400)
             ->height(400);

        $this->addMediaConversion('card')
             ->width(800)
             ->height(800);
    }

    // ═══════════════════════════════
    // RELACIONES
    // ═══════════════════════════════
    public function categoria()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function downloads()
    {
        return $this->hasMany(Download::class);
    }

    // ═══════════════════════════════
    // SCOPES
    // Product::activo()->get()
    // Product::destacado()->get()
    // Product::enCategoria('cumpleanos')->get()
    // ═══════════════════════════════
    public function scopeActivo($query)
    {
        return $query->where('estado', 'activo');
    }

    public function scopeDestacado($query)
    {
        return $query->where('destacado', true);
    }

    public function scopeGratis($query)
    {
        return $query->where('precio', 0);
    }

    public function scopeEnCategoria($query, $slug)
    {
        return $query->whereHas('categoria', fn($q) =>
            $q->where('slug', $slug)
        );
    }

    public function scopeConDescuento($query)
    {
        return $query->whereNotNull('precio_original')
                     ->whereColumn('precio', '<', 'precio_original');
    }

    public function scopeBuscar($query, $termino)
    {
        return $query->where(function($q) use ($termino) {
            $q->where('nombre', 'LIKE', "%{$termino}%")
              ->orWhere('descripcion', 'LIKE', "%{$termino}%")
              ->orWhereJsonContains('tags', $termino);
        });
    }

    // ═══════════════════════════════
    // ACCESSORS
    // $producto->imagen_url
    // $producto->thumb_url
    // $producto->porcentaje_descuento
    // $producto->tiene_descuento
    // $producto->badge_label
    // ═══════════════════════════════
    public function getImagenUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('imagen', 'card')
            ?: asset('images/producto-default.png');
    }

    public function getThumbUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('imagen', 'thumb')
            ?: asset('images/producto-default.png');
    }

    public function getTieneDescuentoAttribute(): bool
    {
        return $this->precio_original &&
               $this->precio < $this->precio_original;
    }

    public function getPorcentajeDescuentoAttribute(): int
    {
        if (!$this->tiene_descuento) return 0;

        return round(
            (($this->precio_original - $this->precio) / $this->precio_original) * 100
        );
    }

    public function getBadgeLabelAttribute(): string
    {
        return match($this->badge) {
            'nuevo'    => '🆕 NUEVO',
            'popular'  => '🔥 POPULAR',
            'oferta'   => "-{$this->porcentaje_descuento}%",
            'editable' => '✏️ EDITABLE',
            'gratis'   => '🆓 GRATIS',
            default    => '',
        };
    }
}
