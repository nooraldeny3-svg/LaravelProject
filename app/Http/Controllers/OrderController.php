<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Handles checkout, booking confirmation, and "My Bookings" for customers.
// All methods here require the user to be logged in (enforced in web.php routes).
class OrderController extends Controller
{
    // Show the checkout form (GET /checkout)
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        return view('checkout.index', compact('cart', 'total'));
    }

    // Process the form and create the order in the database (POST /checkout)
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'travel_date'    => 'required|date|after:today',
        ]);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Step 1: Create the main order record
        $order = Order::create([
            'user_id'        => Auth::id(),
            'total_price'    => $total,
            'status'         => 'pending',
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'travel_date'    => $request->travel_date,
        ]);

        // Step 2: Create one order_item row for each tour in the cart
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price'], // snapshot of price at booking time
            ]);
        }

        // Step 3: Clear the cart
        session()->forget('cart');

        return redirect()->route('orders.confirmation', $order->id)
                         ->with('success', 'Your booking has been placed successfully!');
    }

    // Booking confirmation page shown after a successful checkout
    public function confirmation($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);

        // Security check: only the person who placed the order can see this page
        if ($order->user_id !== Auth::id()) {
            abort(403, 'This is not your order.');
        }

        return view('checkout.confirmation', compact('order'));
    }

    // "My Bookings" page — shows all orders for the logged-in user
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
                       ->with('orderItems')
                       ->latest()
                       ->get();

        return view('orders.index', compact('orders'));
    }
}
