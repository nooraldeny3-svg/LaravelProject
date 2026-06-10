@extends('layouts.app')
@section('title', $product->title . ' — TechShop')

@section('content')

<div class="pg-head">
  <div class="container">
    <div class="pg-head-inner">
      <a href="{{ route('products') }}" class="pg-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Back to Products
      </a>
      @if($product->category)
        <div style="display:flex;align-items:center;gap:6px;font-size:.84rem;color:var(--tx3);margin-bottom:6px">
          <a href="{{ route('products') }}" style="color:var(--tx3)" onmouseover="this.style.color='var(--p)'" onmouseout="this.style.color='var(--tx3)'">Products</a>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
          <a href="{{ route('products', ['category' => $product->category_id]) }}" style="color:var(--tx3)" onmouseover="this.style.color='var(--p)'" onmouseout="this.style.color='var(--tx3)'">{{ $product->category->name }}</a>
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
          <span style="color:var(--tx2)">{{ Str::limit($product->title, 30) }}</span>
        </div>
      @endif
    </div>
  </div>
</div>

<div class="container">
  <div class="pd-grid">

    {{-- Product Image --}}
    <div>
      <div class="pd-img">
        @if($product->image)
          <img src="{{ $product->image }}" alt="{{ $product->title }}">
        @else
          <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--tx3)">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
          </div>
        @endif
      </div>
      {{-- Trust badges --}}
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:16px">
        @foreach([
          ['icon'=>'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z','text'=>'2-Year Warranty'],
          ['icon'=>'M5 13l4 4L19 7','text'=>'Genuine Product'],
          ['icon'=>'M13 10V3L4 14h7v7l9-11h-7z','text'=>'Fast Delivery'],
          ['icon'=>'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15','text'=>'30-Day Returns'],
        ] as $b)
          <div style="background:var(--sf2);border:1px solid var(--bd);border-radius:var(--r2);padding:10px 12px;display:flex;align-items:center;gap:8px">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--p)" stroke-width="2" stroke-linecap="round"><path d="{{ $b['icon'] }}"/></svg>
            <span style="font-size:.8rem;font-weight:600;color:var(--tx2)">{{ $b['text'] }}</span>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Product Info --}}
    <div>
      @if($product->brand)
        <div class="pd-brand">{{ $product->brand }}</div>
      @endif
      <h1 class="pd-title">{{ $product->title }}</h1>

      @if($product->category)
        <div class="card-badge" style="margin-bottom:16px">{{ $product->category->name }}</div>
      @endif

      <div class="pd-price">${{ number_format($product->price, 2) }}</div>

      <div class="pd-stock">
        @if($product->stock === 0)
          <span style="color:var(--err)">Out of stock</span>
        @elseif($product->stock < 10)
          <span style="color:var(--warn)">Only {{ $product->stock }} left in stock — order soon!</span>
        @else
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline;vertical-align:middle"><polyline points="20 6 9 17 4 12"/></svg>
          In Stock ({{ $product->stock }} available)
        @endif
      </div>

      <p class="pd-desc">{{ $product->description }}</p>

      <div class="pd-meta">
        @if($product->brand)
          <div class="pd-meta-i"><small>Brand</small><span>{{ $product->brand }}</span></div>
        @endif
        @if($product->category)
          <div class="pd-meta-i"><small>Category</small><span>{{ $product->category->name }}</span></div>
        @endif
        <div class="pd-meta-i"><small>Availability</small><span style="color:{{ $product->is_available ? 'var(--ok)' : 'var(--err)' }}">{{ $product->is_available ? 'Available' : 'Unavailable' }}</span></div>
        <div class="pd-meta-i"><small>Stock</small><span>{{ $product->stock }} units</span></div>
      </div>

      @if($product->is_available && $product->stock > 0)
        <form method="POST" action="{{ route('cart.add', $product->id) }}" style="display:flex;flex-direction:column;gap:12px">
          @csrf
          <button type="submit" class="btn btn-p btn-lg btn-fw">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
            Add to Cart
          </button>
        </form>
        <a href="{{ route('cart.index') }}" class="btn btn-o btn-fw" style="margin-top:10px;justify-content:center">View Cart</a>
      @else
        <button class="btn btn-s btn-fw btn-lg" disabled style="cursor:not-allowed;opacity:.6">
          {{ !$product->is_available ? 'Currently Unavailable' : 'Out of Stock' }}
        </button>
      @endif

    </div>
  </div>

  {{-- Related Products --}}
  @if($related->isNotEmpty())
    <section class="section-sm" style="border-top:1px solid var(--bd);margin-top:20px">
      <h2 style="margin-bottom:28px">Related <span class="text-grad">Products</span></h2>
      <div class="prod-grid">
        @foreach($related as $rel)
          <div class="card" style="display:flex;flex-direction:column">
            <a href="{{ route('products.show', $rel->id) }}">
              @if($rel->image)
                <img class="card-img" src="{{ $rel->image }}" alt="{{ $rel->title }}" loading="lazy">
              @else
                <div class="card-ph"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/></svg></div>
              @endif
            </a>
            <div class="card-body" style="flex:1;display:flex;flex-direction:column">
              @if($rel->brand)<div class="card-brand">{{ $rel->brand }}</div>@endif
              <a href="{{ route('products.show', $rel->id) }}" class="card-title">{{ $rel->title }}</a>
              <div class="card-price">${{ number_format($rel->price, 0) }}</div>
              <div style="margin-top:auto">
                <form method="POST" action="{{ route('cart.add', $rel->id) }}">
                  @csrf
                  <button type="submit" class="btn btn-p btn-fw btn-sm">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endif

</div>

@endsection
