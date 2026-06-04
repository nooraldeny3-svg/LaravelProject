<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

// The cart is stored entirely in the PHP session — no database table needed.
//
// Session cart structure (keyed by product ID):
// $cart = [
//   1 => ['product_id' => 1, 'title' => 'Bosphorus Cruise', 'price' => 89.00, 'quantity' => 2],
// ]
class CartController extends Controller
{
    // Show the cart page with all items and the grand total
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('cart.index', compact('cart', 'total'));
    }

    // Add a tour to the cart (called from the tour detail page)
    public function add(Request $request, Product $product)
    {
        if (!$product->is_available) {
            return back()->with('error', 'Sorry, this tour is currently unavailable.');
        }

        $cart = session()->get('cart', []);
        $id   = $product->id;

        // If already in cart just increase the traveler count by 1
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

    // Update the number of travelers for a specific tour
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

    // Remove a tour from the cart
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        return back()->with('success', 'Tour removed from cart.');
    }
}
