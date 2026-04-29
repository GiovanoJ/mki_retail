<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),

            'active_products' => Product::active()->count(),

            'out_of_stock'=> Product::where('is_active', true)
                ->whereDoesntHave('variants', function ($q) {
                    $q->where('is_active', true)->where('stock', '>', 0);
                })
                ->whereHas('variants', function ($q) {
                    $q->where('is_active', true);
                })
                ->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
