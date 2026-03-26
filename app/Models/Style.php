<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Style extends Model
{
    use HasSlug;

    protected $fillable = [
        'nombre',
        'slug',
        'icono',
        'estado',
        'orden',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    // Genera el slug automáticamente desde el nombre
    // "Harry Potter" → "harry-potter"
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre')
            ->saveSlugsTo('slug');
    }

    // Un estilo tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Product::class);
    }

    // Scope para traer solo los visibles
    public function scopeVisible($query)
    {
        return $query->where('estado', true);
    }

    public function scopeOrdenado($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }
}
