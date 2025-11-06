<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::active()
            ->inStock()
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home', compact('featuredProducts', 'categories'));
    }
}
