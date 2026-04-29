<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    const CATEGORIES = [
        'wall_panel' => 'Wall Panel',
        'decking'    => 'Decking',
        'facade'     => 'Facade',
        'ceiling'    => 'Ceiling',
        'flooring'   => 'Flooring',
        'door'       => 'Door',
        'rotan'      => 'Rotan',
        'kabel'      => 'Kabel',
    ];

    protected $fillable = [
        'name', 'slug', 'description', 'price',
        'category',
        'specifications', 'is_active',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'is_active'      => 'boolean',
        'specifications' => 'array',
        'category'       => 'array',
    ];

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function activeVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInCategory($query, string $slug)
    {
        if (!array_key_exists($slug, self::CATEGORIES)) {
            return $query->whereRaw('1=0');
        }
        return $query->whereJsonContains('category', $slug);
    }

    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function totalStock(): int
    {
        return $this->variants()->where('is_active', true)->sum('stock');
    }

    public function categoryLabels(): array
    {
        return array_values(array_filter(
            array_map(fn($slug) =>
                self::CATEGORIES[$slug] ?? ucwords(str_replace(['_', '-'], ' ', $slug)),
                $this->category ?? []
            ),
            fn($l) => $l !== ''
        ));
    }

    public function standardCategorySlugs(): array
    {
        return array_values(array_filter(
            $this->category ?? [],
            fn($slug) => array_key_exists($slug, self::CATEGORIES)
        ));
    }

    public function customCategoryLabels(): array
    {
        return array_values(array_filter(
            $this->category ?? [],
            fn($slug) => !array_key_exists($slug, self::CATEGORIES)
        ));
    }
    public function firstImage(): ?string
    {
        return $this->variants->where('is_active', true)->whereNotNull('image_path')->first()?->image_path;
    }
}
