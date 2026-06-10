<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        if (!$product->is_available || $product->stock < 1) {
            return back()->with('error', 'Sorry, this product is currently unavailable.');
        }

        $cart = session()->get('cart', []);
        $id   = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id' => $product->id,
                'title'      => $product->title,
                'price'      => $product->price,
                'quantity'   => 1,
                'image'      => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', '"' . $product->title . '" added to your cart!');
    }

    public function update(Request $request, $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:20']);

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cart updated.');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item removed from cart.');
    }
}
