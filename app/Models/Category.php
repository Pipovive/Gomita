<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'nombre',
        'slug',
        'emoji',
        'descripcion',
        'imagen',
        'color',
        'visible',
        'destacada',
        'orden',
    ];

    protected $casts = [
        'visible'   => 'boolean',
        'destacada' => 'boolean',
        'orden'     => 'integer',
    ];

    // ═══════════════════════════════
    // SLUG AUTOMÁTICO
    // genera slug desde el nombre
    // ej: "Cumpleaños" → "cumpleanos"
    // ═══════════════════════════════
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    // ═══════════════════════════════
    // MEDIA
    // ═══════════════════════════════
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('imagen')
            ->singleFile(); // solo una imagen por categoría
    }

    // ═══════════════════════════════
    // RELACIONES
    // ═══════════════════════════════
    public function productos()
    {
        return $this->hasMany(Product::class);
    }

    public function productosActivos()
    {
        return $this->hasMany(Product::class)
            ->where('estado', 'activo');
    }

    // ═══════════════════════════════
    // SCOPES
    // Category::visible()->get()
    // Category::destacada()->get()
    // ═══════════════════════════════
    public function scopeVisible($query)
    {
        return $query->where('visible', true);
    }

    public function scopeDestacada($query)
    {
        return $query->where('destacada', true);
    }

    public function scopeOrdenada($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }

    // ═══════════════════════════════
    // ACCESSORS
    // $categoria->imagen_url
    // ═══════════════════════════════
    public function getImagenUrlAttribute(): string
    {
        return $this->getFirstMediaUrl('imagen')
            ?: asset('images/categoria-default.png');
    }
}
