<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $activeTab = $request->get('category', 'all');

        $query = Product::active()
            ->with(['variants' => fn($q) => $q->where('is_active', true)->orderBy('id')]);

        if ($activeTab !== 'all') {
            $query->inCategory($activeTab);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(24)->withQueryString();
        $tabs     = array_merge(['all' => 'Semua'], Product::CATEGORIES);
        $promos   = Promo::active()->get();

        return view('products.index', compact('products', 'tabs', 'activeTab', 'promos'));
    }

    public function show(Product $product)
    {
        abort_if(! $product->is_active, 404);

        $product->load(['variants' => fn($q) => $q->where('is_active', true)->orderBy('id')]);

        return view('products.show', compact('product'));
    }
}
