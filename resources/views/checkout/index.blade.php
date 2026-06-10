@extends('layouts.app')
@section('title', 'Checkout — TechShop')

@section('content')

<div class="pg-head">
  <div class="container">
    <div class="pg-head-inner">
      <a href="{{ route('cart.index') }}" class="pg-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Cart
      </a>
      <h1>Checkout</h1>
      <p class="pg-sub">You're almost done — fill in your delivery details</p>
    </div>
  </div>
</div>

<div class="container">
  <div class="co-layout">

    {{-- Form --}}
    <div>
      <div class="co-card">

        @if($errors->any())
          <div style="background:var(--err-bg);border:1px solid rgba(239,68,68,.25);border-radius:var(--r3);padding:14px 18px;margin-bottom:22px">
            <p style="font-weight:600;font-size:.9rem;color:var(--err);margin-bottom:6px">Please fix the following errors:</p>
            <ul style="padding-left:18px;font-size:.85rem;color:var(--err)">
              @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('checkout.store') }}">
          @csrf

          {{-- Contact Info --}}
          <div class="co-sec">
            <div class="co-num">1</div>
            Contact Information
          </div>
          <div class="fr mb-3">
            <div class="fg">
              <label class="fl" for="customer_name">Full Name <span>*</span></label>
              <input type="text" id="customer_name" name="customer_name" class="fi @error('customer_name') is-err @enderror"
                value="{{ old('customer_name', auth()->user()->name) }}" placeholder="John Smith" required autocomplete="name">
              @error('customer_name')<div class="fe">{{ $message }}</div>@enderror
            </div>
            <div class="fg">
              <label class="fl" for="customer_phone">Phone Number <span>*</span></label>
              <input type="tel" id="customer_phone" name="customer_phone" class="fi @error('customer_phone') is-err @enderror"
                value="{{ old('customer_phone') }}" placeholder="+1 555 000 0000" required autocomplete="tel">
              @error('customer_phone')<div class="fe">{{ $message }}</div>@enderror
            </div>
          </div>

          {{-- Delivery --}}
          <div class="co-sec">
            <div class="co-num">2</div>
            Delivery Details
          </div>
          <div class="fg">
            <label class="fl" for="shipping_address">Shipping Address <span>*</span></label>
            <textarea id="shipping_address" name="shipping_address" class="ft @error('shipping_address') is-err @enderror"
              placeholder="Street address, city, state, zip code" required autocomplete="street-address" rows="3">{{ old('shipping_address') }}</textarea>
            @error('shipping_address')<div class="fe">{{ $message }}</div>@enderror
          </div>
          <div class="fg" style="margin-bottom:28px">
            <label class="fl" for="delivery_date">Preferred Delivery Date <span>*</span></label>
            <input type="date" id="delivery_date" name="delivery_date" class="fi @error('delivery_date') is-err @enderror"
              value="{{ old('delivery_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
            <div class="fh">Select a date at least 1 day from today.</div>
            @error('delivery_date')<div class="fe">{{ $message }}</div>@enderror
          </div>

          {{-- Payment notice --}}
          <div class="pay-note">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <div>
              <p><strong style="color:var(--tx)">No online payment required.</strong> Our team will contact you within 24 hours to arrange a convenient payment method.</p>
            </div>
          </div>

          <button type="submit" class="btn btn-p btn-fw btn-lg" style="margin-top:24px">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            Place My Order
          </button>
        </form>
      </div>
    </div>

    {{-- Order Summary --}}
    <div>
      <div class="cart-sum" style="position:sticky;top:calc(var(--nav-h) + 18px)">
        <h3 style="margin-bottom:18px">Order Summary</h3>
        @foreach($cart as $item)
          <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:10px;padding:10px 0;border-bottom:1px solid var(--bd)">
            <div style="flex:1;min-width:0">
              <div style="font-weight:600;font-size:.9rem;color:var(--tx)">{{ $item['title'] }}</div>
              <div style="font-size:.8rem;color:var(--tx3);margin-top:2px">{{ $item['quantity'] }} &times; ${{ number_format($item['price'], 2) }}</div>
            </div>
            <div style="font-weight:700;font-size:.95rem;color:var(--p);white-space:nowrap">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
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
      </div>
    </div>

  </div>
</div>

@endsection
