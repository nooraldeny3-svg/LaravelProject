@extends('layouts.app')
@section('title', 'Your Cart — TechShop')

@section('content')

<div class="pg-head">
  <div class="container">
    <div class="pg-head-inner">
      <a href="{{ route('products') }}" class="pg-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Continue Shopping
      </a>
      <h1>Shopping Cart</h1>
      <p class="pg-sub">Review your items before checkout</p>
    </div>
  </div>
</div>

<div class="container">
  @if(empty($cart))
    <div class="empty">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
      <h3>Your cart is empty</h3>
      <p>Browse our latest products and add something you love.</p>
      <a href="{{ route('products') }}" class="btn btn-p">Browse Products</a>
    </div>
  @else
    <div class="cart-layout">

      {{-- Cart Items --}}
      <div>
        <div style="background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);overflow:hidden">
          <div style="padding:18px 22px;border-bottom:1px solid var(--bd);display:flex;justify-content:space-between;align-items:center">
            <h3>Items ({{ collect($cart)->sum('quantity') }})</h3>
          </div>
          @foreach($cart as $productId => $item)
            <div class="cart-item">
              @if($item['image'])
                <img class="ci-img" src="{{ $item['image'] }}" alt="{{ $item['title'] }}">
              @else
                <div class="ci-img" style="display:flex;align-items:center;justify-content:center;color:var(--tx3)">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
                </div>
              @endif
              <div class="ci-info">
                <div class="ci-name">{{ $item['title'] }}</div>
                <div class="ci-price">${{ number_format($item['price'], 2) }} each</div>
              </div>
              <div class="ci-acts">
                <form method="POST" action="{{ route('cart.update', $productId) }}" style="display:flex;align-items:center;gap:6px">
                  @csrf
                  <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="20" class="qty">
                  <button type="submit" class="btn-i" style="width:36px;height:36px" title="Update">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                  </button>
                </form>
                <div style="font-weight:700;color:var(--p);font-size:1rem;min-width:70px;text-align:right">
                  ${{ number_format($item['price'] * $item['quantity'], 2) }}
                </div>
                <form method="POST" action="{{ route('cart.remove', $productId) }}">
                  @csrf
                  <button type="submit" class="btn-i" style="width:36px;height:36px;border-color:var(--err-bg);color:var(--err)" title="Remove">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Summary --}}
      <div>
        <div class="cart-sum">
          <h3>Order Summary</h3>
          @foreach($cart as $item)
            <div class="sum-row">
              <span style="color:var(--tx2)">{{ Str::limit($item['title'], 24) }} &times;{{ $item['quantity'] }}</span>
              <span style="font-weight:600">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
            </div>
          @endforeach
          <hr class="divider">
          <div class="sum-row" style="border:none">
            <span>Shipping</span>
            <span style="color:var(--ok);font-weight:600">{{ $total >= 99 ? 'Free' : '$9.99' }}</span>
          </div>
          <div class="sum-tot">
            <span>Total</span>
            <span>${{ number_format($total >= 99 ? $total : $total + 9.99, 2) }}</span>
          </div>

          @if($total < 99)
            <div style="background:var(--p-tint);border:1px solid var(--bd2);border-radius:var(--r2);padding:10px 12px;font-size:.84rem;margin-bottom:16px">
              <strong style="color:var(--p)">Add ${{ number_format(99 - $total, 2) }} more</strong> to get free shipping!
            </div>
          @endif

          @auth
            <a href="{{ route('checkout') }}" class="btn btn-p btn-fw btn-lg">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
              Secure Checkout
            </a>
          @else
            <a href="{{ route('login') }}" class="btn btn-p btn-fw btn-lg">Login to Checkout</a>
            <p style="text-align:center;font-size:.84rem;color:var(--tx3);margin-top:10px">
              No account? <a href="{{ route('register') }}" style="color:var(--p);font-weight:600">Register free</a>
            </p>
          @endauth

          <div style="margin-top:16px;display:flex;flex-direction:column;gap:8px">
            @foreach(['Encrypted & secure checkout','No payment online — we contact you','Easy returns within 30 days'] as $note)
              <div style="display:flex;align-items:center;gap:8px;font-size:.8rem;color:var(--tx3)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--ok)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                {{ $note }}
              </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  @endif
</div>

@endsection
