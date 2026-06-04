@extends('layouts.app')
@section('title', 'Your Cart — TurkeyTours')

@section('styles')
<style>
    .cart-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 1.8rem;
        padding: 3rem 0;
    }
    .cart-table-wrap {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table thead th {
        background: var(--navy);
        color: rgba(255,255,255,0.72);
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 1.3px;
        text-transform: uppercase;
        padding: 0.9rem 1rem;
        text-align: left;
    }
    .cart-table tbody td {
        padding: 1.1rem 1rem;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-size: 0.875rem;
    }
    .cart-table tbody tr:last-child td { border-bottom: none; }
    .cart-table tbody tr:hover { background: #fafafa; }
    .cart-item-img {
        width: 68px; height: 52px;
        border-radius: 5px;
        object-fit: cover;
    }
    .cart-img-ph {
        width: 68px; height: 52px;
        border-radius: 5px;
        background: linear-gradient(135deg, var(--navy), var(--navy-mid));
    }
    .cart-title {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 0.92rem;
        color: var(--navy);
    }
    .qty-wrap { display: flex; align-items: center; gap: 0.4rem; }
    .qty-input {
        width: 65px;
        border: 1.5px solid var(--border);
        border-radius: 5px;
        padding: 0.38rem 0.55rem;
        font-size: 0.88rem;
        font-weight: 600;
        text-align: center;
        color: var(--navy);
        outline: none;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .qty-input:focus { border-color: var(--red); }
    .btn-qty {
        background: var(--navy);
        color: white;
        border: none;
        border-radius: 5px;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.82rem;
        cursor: pointer;
        transition: background 0.2s;
        font-family: inherit;
    }
    .btn-qty:hover { background: var(--red); }
    .btn-remove {
        background: #fee2e2;
        color: #991b1b;
        border: none;
        border-radius: 5px;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
        font-size: 0.85rem;
        font-family: inherit;
    }
    .btn-remove:hover { background: #dc2626; color: white; }

    .summary-card {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        overflow: hidden;
        position: sticky;
        top: 80px;
    }
    .summary-head {
        background: var(--navy);
        padding: 1.1rem 1.4rem;
        color: white;
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        font-size: 0.97rem;
    }
    .summary-body { padding: 1.4rem; }
    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.84rem;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }
    .summary-row strong { color: var(--navy); }
    .summary-total {
        font-family: 'Playfair Display', serif;
        font-size: 1.7rem;
        font-weight: 800;
        color: var(--red);
    }
    .summary-notes {
        background: #f8fafc;
        border-radius: 6px;
        padding: 0.8rem 1rem;
        margin-top: 1rem;
    }
    .note-row {
        display: flex;
        align-items: center;
        gap: 0.45rem;
        font-size: 0.77rem;
        color: var(--gray);
        margin-bottom: 0.3rem;
    }
    .note-row:last-child { margin-bottom: 0; }
    .note-row .n-icon { color: var(--red); }

    .empty-cart {
        text-align: center;
        padding: 5rem 0;
    }
    .empty-icon-wrap {
        width: 90px; height: 90px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.4rem;
        font-size: 2.2rem;
        color: var(--gray);
    }

    @media (max-width: 860px) {
        .cart-layout { grid-template-columns: 1fr; }
        .summary-card { position: static; }
    }
    @media (max-width: 560px) {
        .cart-table thead { display: none; }
        .cart-table tbody td { display: block; padding: 0.5rem 1rem; }
        .cart-table tbody td:first-child { padding-top: 1rem; }
        .cart-table tbody td:last-child { padding-bottom: 1rem; }
    }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Ready to Book</div>
        <h1 class="section-title" style="color:white;">Your Cart</h1>
    </div>
</div>

<div class="container">
    @if(empty($cart))
        <div class="empty-cart">
            <div class="empty-icon-wrap">&#128704;</div>
            <h3 style="font-family:'Playfair Display',serif;margin-bottom:0.5rem;">Your cart is empty</h3>
            <p class="text-muted" style="margin-bottom:1.3rem;">Discover our amazing tour packages and start your Turkish adventure.</p>
            <a href="{{ route('tours') }}" class="btn btn-primary">Browse Tours</a>
        </div>
    @else
        <div class="cart-layout">

            <!-- Cart Items -->
            <div>
                <div class="cart-table-wrap">
                    <div style="overflow-x:auto;">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Tour</th>
                                    <th>Price</th>
                                    <th>Travelers</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $productId => $item)
                                <tr>
                                    <td>
                                        <div style="display:flex;align-items:center;gap:0.85rem;">
                                            @if($item['image'])
                                                <img src="{{ $item['image'] }}" class="cart-item-img" alt="{{ $item['title'] }}">
                                            @else
                                                <div class="cart-img-ph"></div>
                                            @endif
                                            <span class="cart-title">{{ $item['title'] }}</span>
                                        </div>
                                    </td>
                                    <td style="font-weight:600;color:var(--navy);">${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.update', $productId) }}" class="qty-wrap">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="20" class="qty-input">
                                            <button type="submit" class="btn-qty" title="Update">&#10003;</button>
                                        </form>
                                    </td>
                                    <td style="font-weight:700;color:var(--red);font-family:'Playfair Display',serif;">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $productId) }}">
                                            @csrf
                                            <button type="submit" class="btn-remove" title="Remove">&#10005;</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="margin-top:0.8rem;">
                    <a href="{{ route('tours') }}" class="btn btn-light">&larr; Continue Browsing</a>
                </div>
            </div>

            <!-- Summary -->
            <div>
                <div class="summary-card">
                    <div class="summary-head">Order Summary</div>
                    <div class="summary-body">
                        @foreach($cart as $item)
                            <div class="summary-row">
                                <span>{{ Str::limit($item['title'], 22) }} &times;{{ $item['quantity'] }}</span>
                                <strong>${{ number_format($item['price'] * $item['quantity'], 2) }}</strong>
                            </div>
                        @endforeach

                        <hr style="border:none;border-top:1px solid #f1f5f9;margin:1rem 0;">

                        <div style="display:flex;justify-content:space-between;align-items:flex-end;">
                            <span style="font-weight:600;color:var(--navy);">Total</span>
                            <div class="summary-total">${{ number_format($total, 2) }}</div>
                        </div>

                        <div style="margin-top:1.3rem;">
                            @auth
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">Proceed to Checkout</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-block">Login to Checkout</a>
                                <p style="text-align:center;font-size:0.78rem;color:var(--gray);margin-top:0.75rem;">
                                    Need an account? <a href="{{ route('register') }}" style="color:var(--red);font-weight:600;">Register free</a>
                                </p>
                            @endauth
                        </div>

                        <div class="summary-notes">
                            <div class="note-row"><span class="n-icon">&#10003;</span> Secure &amp; encrypted checkout</div>
                            <div class="note-row"><span class="n-icon">&#9742;</span> We'll contact you to confirm payment</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
