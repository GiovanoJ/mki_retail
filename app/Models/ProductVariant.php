<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'attributes',
        'price_override',
        'stock',
        'image_path',
        'specifications',
        'is_active',
        'color',
    ];

    protected $casts = [
        'price_override' => 'decimal:2',
        'stock'          => 'integer',
        'is_active'      => 'boolean',
        'attributes'     => 'array',
        'specifications' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function effectivePrice(): float
    {
        return (float) ($this->price_override ?? $this->product->price);
    }

    public function formattedPrice(): string
    {
        return 'Rp ' . number_format($this->effectivePrice(), 0, ',', '.');
    }

    public function label(): string
    {
        if (empty($this->attributes)) {
            return $this->sku;
        }

        $values = array_column($this->attributes, 'value');
        return implode(' / ', array_filter($values)) ?: $this->sku;
    }

    public function getVariantAttributeValue(string $key): ?string
    {
        foreach ($this->attributes ?? [] as $attr) {
            if (strtolower($attr['key'] ?? '') === strtolower($key)) {
                return $attr['value'] ?? null;
            }
        }
        return null;
    }

    public function colorHex(): ?string
    {
        foreach ($this->attributes ?? [] as $attr) {
            if (isset($attr['hex']) && preg_match('/^#[0-9a-fA-F]{6}$/', $attr['hex'])) {
                return $attr['hex'];
            }
        }
        return null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function toPublicArray(): array
    {
        return [
            'id'             => $this->id,
            'sku'            => $this->sku,
            'price'          => $this->formattedPrice(),
            'stock'          => $this->stock,
            'image_path'     => $this->image_path,
            'attributes'     => $this->attributes ?? [],
            'specifications' => $this->specifications ?? [],
            'label'          => $this->label(),
            'color'          => $this->color ?: $this->colorHex(),
        ];
    }
}
