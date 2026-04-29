<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::active()->latest()->take(8)->get();

        return view('home.index', compact('featured'));
    }
}
