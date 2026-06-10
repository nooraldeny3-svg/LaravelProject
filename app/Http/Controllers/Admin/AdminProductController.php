<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'brand'        => 'nullable|string|max:100',
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'image'        => 'nullable|url|max:500',
            'is_available' => 'boolean',
        ]);

        Product::create([
            'category_id'  => $request->category_id,
            'brand'        => $request->brand,
            'title'        => $request->title,
            'description'  => $request->description,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'image'        => $request->image,
            'is_available' => $request->boolean('is_available'),
        ]);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'brand'        => 'nullable|string|max:100',
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'image'        => 'nullable|url|max:500',
            'is_available' => 'boolean',
        ]);

        $product->update([
            'category_id'  => $request->category_id,
            'brand'        => $request->brand,
            'title'        => $request->title,
            'description'  => $request->description,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'image'        => $request->image,
            'is_available' => $request->boolean('is_available'),
        ]);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted.');
    }
}
