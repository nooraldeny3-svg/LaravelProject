<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

// Admin dashboard — shows summary statistics
class AdminHomeController extends Controller
{
    public function index()
    {
        $totalTours      = Product::count();
        $totalCategories = Category::count();
        $totalOrders     = Order::count();

        // Revenue = sum of total_price for confirmed orders only
        $totalRevenue = Order::where('status', 'confirmed')->sum('total_price');

        // Show the 5 most recent orders in a quick-view table
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.home', compact(
            'totalTours', 'totalCategories', 'totalOrders', 'totalRevenue', 'recentOrders'
        ));
    }
}
