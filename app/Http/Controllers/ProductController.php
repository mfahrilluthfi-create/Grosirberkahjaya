<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::active()->with('category');

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Category filter
        if ($request->filled('category')) {
            $categories = is_array($request->category) ? $request->category : [$request->category];
            $query->whereHas('category', function ($q) use ($categories) {
                $q->whereIn('slug', $categories);
            });
        }

        // Price range filter
        if ($request->filled('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) == 2) {
                $minPrice = (int) $range[0];
                $maxPrice = (int) $range[1];
                $query->where(function ($q) use ($minPrice, $maxPrice) {
                    $q->whereRaw('(price * (100 - discount) / 100) >= ?', [$minPrice])
                      ->whereRaw('(price * (100 - discount) / 100) <= ?', [$maxPrice]);
                });
            }
        }

        // Stock filter
        if ($request->filled('in_stock')) {
            $query->where('stock', '>', 0);
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderByRaw('(price * (100 - discount) / 100) ASC');
                    break;
                case 'price_high':
                    $query->orderByRaw('(price * (100 - discount) / 100) DESC');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        // ✅ cukup satu return
        return view('products', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->active()->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->inStock()
            ->take(4)
            ->get();

        return view('product-detail', compact('product', 'relatedProducts'));
    }
}
