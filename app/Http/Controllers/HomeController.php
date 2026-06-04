<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

// Handles all public-facing pages: home, tours list, tour detail, cities list
class HomeController extends Controller
{
    // Home page — show a welcome banner + 6 featured tours
    public function index()
    {
        $featuredTours = Product::where('is_available', true)
                                ->with('category')
                                ->latest()
                                ->take(6)
                                ->get();

        return view('home', compact('featuredTours'));
    }

    // Tours page — show all available tours, with optional city filter
    public function tours(Request $request)
    {
        $categories = Category::all();

        $query = Product::where('is_available', true)->with('category');

        // If the user picked a city from the dropdown, filter by that city
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $tours = $query->get();

        return view('tours.index', compact('tours', 'categories'));
    }

    // Single tour detail page
    public function tourDetail(Product $product)
    {
        $product->load('category');
        return view('tours.show', compact('product'));
    }

    // Cities page — show all cities with their tour count
    public function cities()
    {
        // withCount adds a products_count attribute to each category
        $categories = Category::withCount('products')->get();
        return view('cities.index', compact('categories'));
    }
}
