<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('cart', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'delivery_date'    => 'required|date|after:today',
        ]);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id'          => Auth::id(),
            'total_price'      => $total,
            'status'           => 'pending',
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'delivery_date'    => $request->delivery_date,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.confirmation', $order->id)
                         ->with('success', 'Order placed successfully!');
    }

    public function confirmation($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.confirmation', compact('order'));
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('orderItems')
                       ->latest()
                       ->get();

        return view('orders.index', compact('orders'));
    }
}
