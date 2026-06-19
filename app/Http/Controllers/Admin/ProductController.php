<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['variants' => fn($q) => $q->where('is_active', true)->orderBy('id')]);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(24)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Product::categories();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'category'      => ['nullable', 'array'],
            'category.*'    => ['string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'description'   => ['nullable', 'string'],
            'is_active'     => ['boolean'],
        ]);

        $knownSlugs = array_keys(Product::categories());

        $categories = array_values(array_filter(
            $request->input('category', []),
            fn($s) => in_array($s, $knownSlugs, true)
        ));

        $custom = $request->filled('custom_categories')
            ? array_values(array_filter(array_map(
                fn($s) => Str::slug(trim($s), '_'),
                explode(',', $request->input('custom_categories'))
              ), fn($s) => $s !== ''))
            : [];

        $allCategories = array_values(array_unique(array_merge($categories, $custom)));
        $baseSlug = Str::slug($request->input('name'));
        $slug     = $baseSlug;
        $i        = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $product = Product::create([
            'name'        => $request->input('name'),
            'slug'        => $slug,
            'category'    => $allCategories,
            'price'       => $request->input('price'),
            'description' => $request->input('description'),
            'is_active'   => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', "Produk \"{$product->name}\" berhasil dibuat. Sekarang tambahkan varian.");
    }

    public function edit(Product $product)
    {
        $categories = Product::categories();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'category'      => ['nullable', 'array'],
            'category.*'    => ['string'],
            'price'         => ['required', 'numeric', 'min:0'],
            'description'   => ['nullable', 'string'],
            'specs'         => ['nullable', 'array'],
            'specs.*.key'   => ['nullable', 'string', 'max:100'],
            'specs.*.value' => ['nullable', 'string', 'max:500'],
            'is_active'     => ['boolean'],
        ]);

        $knownSlugs = array_keys(Product::categories());

        $categories = array_values(array_filter(
            $request->input('category', []),
            fn($s) => in_array($s, $knownSlugs, true)
        ));

        $custom = $request->filled('custom_categories')
            ? array_values(array_filter(array_map(
                fn($s) => Str::slug(trim($s), '_'),
                explode(',', $request->input('custom_categories'))
              ), fn($s) => $s !== ''))
            : [];

        $allCategories = array_values(array_unique(array_merge($categories, $custom)));

        $specs = array_values(array_filter(
            array_map(fn($r) => [
                'key'   => trim($r['key']   ?? ''),
                'value' => trim($r['value'] ?? ''),
            ], $request->input('specs', [])),
            fn($r) => $r['key'] !== '' && $r['value'] !== ''
        ));

        $slug = $product->slug;
        if ($request->input('name') !== $product->name) {
            $baseSlug  = Str::slug($request->input('name'));
            $candidate = $baseSlug;
            $i         = 1;
            while (Product::where('slug', $candidate)->where('id', '!=', $product->id)->exists()) {
                $candidate = $baseSlug . '-' . $i;
                $i++;
            }
            $slug = $candidate;
        }

        $product->update([
            'name'           => $request->input('name'),
            'slug'           => $slug,
            'category'       => $allCategories,
            'price'          => $request->input('price'),
            'description'    => $request->input('description'),
            'specifications' => $specs,
            'is_active'      => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.products.variants.index', $product)
            ->with('success', "Produk \"{$product->name}\" berhasil diperbarui.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Produk \"{$name}\" berhasil dihapus.");
    }
}
