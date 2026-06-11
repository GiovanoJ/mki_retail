<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductVariantController extends Controller
{
    public function index(Product $product)
    {
        $variants = $product->variants()->latest()->get();
        return view('admin.products.variants.index', compact('product', 'variants'));
    }

    public function create(Product $product)
    {
        return view('admin.products.variants.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku'                => ['required', 'string', 'max:100', 'unique:product_variants,sku'],
            'price_override'     => ['nullable', 'numeric', 'min:0'],
            'stock'              => ['required', 'integer', 'min:0'],
            'image'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active'          => ['boolean'],
            'color'              => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'attributes'         => ['nullable', 'array'],
            'attributes.*.key'   => ['nullable', 'string', 'max:100'],
            'attributes.*.value' => ['nullable', 'string', 'max:500'],
            'specs'              => ['nullable', 'array'],
            'specs.*.key'        => ['nullable', 'string', 'max:100'],
            'specs.*.value'      => ['nullable', 'string', 'max:500'],
        ]);

        $data = [
            'product_id'     => $product->id,
            'sku'            => $validated['sku'],
            'price_override' => $request->filled('price_override') ? $validated['price_override'] : null,
            'stock'          => $validated['stock'],
            'is_active'      => $request->boolean('is_active', true),
            'color'          => $request->filled('color') ? $validated['color'] : null,
            'attributes'     => $this->parseAttributes($request->input('attributes', [])),
            'specifications' => $this->parseKV($request->input('specs', [])),
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')
                ->store("products/{$product->id}/variants", 'public');
        }

        ProductVariant::create($data);

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', "Varian {$data['sku']} berhasil ditambahkan.");
    }

    public function edit(Product $product, ProductVariant $variant)
    {
        abort_if($variant->product_id !== $product->id, 404);
        return view('admin.products.variants.edit', compact('product', 'variant'));
    }

    public function update(Request $request, Product $product, ProductVariant $variant)
    {
        abort_if($variant->product_id != $product->id, 404);

        $validated = $request->validate([
            'sku'                => ['required', 'string', 'max:100', "unique:product_variants,sku,{$variant->id}"],
            'price_override'     => ['nullable', 'numeric', 'min:0'],
            'stock'              => ['required', 'integer', 'min:0'],
            'image'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_active'          => ['boolean'],
            'color'              => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'attributes'         => ['nullable', 'array'],
            'attributes.*.key'   => ['nullable', 'string', 'max:100'],
            'attributes.*.value' => ['nullable', 'string', 'max:500'],
            'specs'              => ['nullable', 'array'],
            'specs.*.key'        => ['nullable', 'string', 'max:100'],
            'specs.*.value'      => ['nullable', 'string', 'max:500'],
        ]);

        $data = [
            'sku'            => $validated['sku'],
            'price_override' => $request->filled('price_override') ? $validated['price_override'] : null,
            'stock'          => $validated['stock'],
            'is_active'      => $request->boolean('is_active'),
            'color'          => $request->filled('color') ? $validated['color'] : null,
            'attributes'     => $this->parseAttributes($request->input('attributes', [])),
            'specifications' => $this->parseKV($request->input('specs', [])),
        ];

        if ($request->hasFile('image')) {
            if ($variant->image_path) {
                Storage::disk('public')->delete($variant->image_path);
            }
            $data['image_path'] = $request->file('image')
                ->store("products/{$product->id}/variants", 'public');
        }

        $variant->update($data);

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', "Varian {$variant->sku} berhasil diperbarui.");
    }

    public function destroy(Product $product, ProductVariant $variant)
    {
        abort_if($variant->product_id != $product->id, 404);

        if ($variant->image_path) {
            Storage::disk('public')->delete($variant->image_path);
        }

        $sku = $variant->sku;
        $variant->delete();

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', "Varian {$sku} berhasil dihapus.");
    }

    private function parseAttributes(array $rows): array
    {
        $out = [];
        foreach ($rows as $row) {
            $key   = trim($row['key']   ?? '');
            $value = trim($row['value'] ?? '');
            if ($key === '' || $value === '') continue;
            $out[] = ['key' => $key, 'value' => $value];
        }
        return $out;
    }

    private function parseKV(array $rows): array
    {
        return array_values(array_filter(
            array_map(fn($r) => [
                'key'   => trim($r['key']   ?? ''),
                'value' => trim($r['value'] ?? ''),
            ], $rows),
            fn($r) => $r['key'] !== '' && $r['value'] !== ''
        ));
    }
}
