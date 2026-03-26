<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class ProductType extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['nombre', 'slug', 'icono', 'activo'];

    // Slug automático igual que en Product
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre')
            ->saveSlugsTo('slug');
    }

    // Un tipo tiene muchos productos
    // Ej: "Cajas" → [producto1, producto2, ...]
    public function productos()
    {
        return $this->hasMany(Product::class);
    }
}
