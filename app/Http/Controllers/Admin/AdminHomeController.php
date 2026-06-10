<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class AdminHomeController extends Controller
{
    public function index()
    {
        $totalProducts   = Product::count();
        $totalCategories = Category::count();
        $totalOrders     = Order::count();
        $totalRevenue    = Order::where('status', 'confirmed')->sum('total_price');
        $recentOrders    = Order::with('user')->latest()->take(5)->get();

        return view('admin.home', compact(
            'totalProducts', 'totalCategories', 'totalOrders', 'totalRevenue', 'recentOrders'
        ));
    }
}
