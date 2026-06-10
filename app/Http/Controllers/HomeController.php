<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_available', true)
                                   ->with('category')
                                   ->latest()
                                   ->take(8)
                                   ->get();

        $categories = Category::withCount('products')->take(5)->get();

        return view('home', compact('featuredProducts', 'categories'));
    }

    public function products(Request $request)
    {
        $categories = Category::all();

        $query = Product::where('is_available', true)->with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('title', 'like', "%{$s}%")
                  ->orWhere('brand', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%");
            });
        }

        $products = $query->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function productDetail(Product $product)
    {
        $product->load('category');

        $related = Product::where('category_id', $product->category_id)
                          ->where('id', '!=', $product->id)
                          ->where('is_available', true)
                          ->take(4)
                          ->get();

        return view('products.show', compact('product', 'related'));
    }

    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.index', compact('categories'));
    }
}
