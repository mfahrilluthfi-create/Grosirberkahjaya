<?php

// File: app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::whereIn('status', ['paid', 'processing', 'shipped', 'delivered'])->sum('total');
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalProducts',
            'totalCustomers',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}
