<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Auth::user()->orders()
            ->with('items.product')
            ->latest()
            ->paginate(10);

        return view('customer.orders', compact('orders'));
    }
}
