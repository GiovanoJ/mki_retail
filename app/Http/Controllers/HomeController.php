<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::active()
            ->with(['variants' => fn($q) => $q->where('is_active', true)->orderBy('id')])
            ->latest()
            ->take(8)
            ->get();

        $latestArticles = Article::published()
            ->latest()
            ->take(3)
            ->get();

        return view('home.index', compact('featured', 'latestArticles'));
    }
}
