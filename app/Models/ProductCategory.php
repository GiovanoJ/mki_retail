<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    protected $fillable = [
        'slug',
        'label',
        'show_in_tab',
        'order',
    ];

    protected $casts = [
        'show_in_tab' => 'boolean',
        'order'       => 'integer',
    ];

    public function scopeShownInTab($query)
    {
        return $query->where('show_in_tab', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('label');
    }

    public function productsCount(): int
    {
        return Product::whereJsonContains('category', $this->slug)->count();
    }

    public function isUsedByProducts(): bool
    {
        return $this->productsCount() > 0;
    }

    public static function generateUniqueSlug(string $label, ?int $ignoreId = null): string
    {
        $base = Str::slug($label, '_');
        $slug = $base;
        $i    = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base . '_' . $i;
            $i++;
        }

        return $slug;
    }

    public static function allAsOptions(): array
    {
        return static::ordered()->get()->pluck('label', 'slug')->all();
    }

    public static function tabOptions(): array
    {
        return static::shownInTab()->ordered()->get()->pluck('label', 'slug')->all();
    }
}
