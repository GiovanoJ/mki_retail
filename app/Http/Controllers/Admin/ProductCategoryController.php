<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::ordered()->get();

        $categories->each(function (ProductCategory $category) {
            $category->setAttribute('products_count', $category->productsCount());
        });

        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'label'       => ['required', 'string', 'max:100'],
            'show_in_tab' => ['boolean'],
            'order'       => ['nullable', 'integer', 'min:0'],
        ]);

        ProductCategory::create([
            'slug'        => ProductCategory::generateUniqueSlug($validated['label']),
            'label'       => $validated['label'],
            'show_in_tab' => $request->boolean('show_in_tab', true),
            'order'       => $validated['order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', "Kategori \"{$validated['label']}\" berhasil ditambahkan.");
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', ['category' => $productCategory]);
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'label'       => ['required', 'string', 'max:100'],
            'show_in_tab' => ['boolean'],
            'order'       => ['nullable', 'integer', 'min:0'],
        ]);

        $productCategory->update([
            'label'       => $validated['label'],
            'show_in_tab' => $request->boolean('show_in_tab'),
            'order'       => $validated['order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', "Kategori \"{$productCategory->label}\" berhasil diperbarui.");
    }

    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->isUsedByProducts()) {
            $count = $productCategory->productsCount();

            return redirect()
                ->route('admin.product-categories.index')
                ->with('error', "Kategori \"{$productCategory->label}\" masih dipakai oleh {$count} produk. Hapus atau ubah kategori produk tersebut dahulu.");
        }

        $label = $productCategory->label;
        $productCategory->delete();

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', "Kategori \"{$label}\" berhasil dihapus.");
    }
}
