@extends('layouts.app')
@section('title', 'Products — TechShop')

@section('content')

<div class="pg-head">
  <div class="container">
    <div class="pg-head-inner">
      <h1>All Products</h1>
      <p class="pg-sub">{{ $products->count() }} product(s) available</p>
    </div>
  </div>
</div>

<div class="container" style="padding-bottom:80px">

  {{-- Search + Filter --}}
  <form method="GET" action="{{ route('products') }}">
    <div class="filter-bar">
      <span class="filter-lbl">Filter:</span>

      <a href="{{ route('products') }}" class="chip {{ !request('category') && !request('search') ? 'on' : '' }}">All</a>

      @foreach($categories as $cat)
        <a href="{{ route('products', ['category' => $cat->id, 'search' => request('search')]) }}"
           class="chip {{ request('category') == $cat->id ? 'on' : '' }}">
          {{ $cat->name }}
        </a>
      @endforeach

      <div style="margin-left:auto;display:flex;gap:8px;flex-wrap:wrap">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="fi" style="width:220px;padding:7px 13px">
        <button type="submit" class="btn btn-p btn-sm">Search</button>
        @if(request('search') || request('category'))
          <a href="{{ route('products') }}" class="btn btn-o btn-sm">Clear</a>
        @endif
      </div>
    </div>
  </form>

  @if($products->isEmpty())
    <div class="empty">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <h3>No products found</h3>
      <p>Try adjusting your search or browse all categories.</p>
      <a href="{{ route('products') }}" class="btn btn-p">Clear Filters</a>
    </div>
  @else
    <div class="prod-grid">
      @foreach($products as $product)
        <div class="card" style="display:flex;flex-direction:column">
          <a href="{{ route('products.show', $product->id) }}" style="display:block">
            @if($product->image)
              <img class="card-img" src="{{ $product->image }}" alt="{{ $product->title }}" loading="lazy">
            @else
              <div class="card-ph">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
              </div>
            @endif
          </a>
          <div class="card-body" style="flex:1;display:flex;flex-direction:column">
            @if($product->category)
              <div class="card-badge">{{ $product->category->name }}</div>
            @endif
            @if($product->brand)
              <div class="card-brand">{{ $product->brand }}</div>
            @endif
            <a href="{{ route('products.show', $product->id) }}" class="card-title">{{ $product->title }}</a>
            <div class="card-price">${{ number_format($product->price, 0) }}</div>
            <div class="card-stock {{ $product->stock === 0 ? 'out' : ($product->stock < 10 ? 'low' : '') }}">
              @if($product->stock === 0) Out of stock
              @elseif($product->stock < 10) Only {{ $product->stock }} left!
              @else {{ $product->stock }} in stock
              @endif
            </div>
            <div style="margin-top:auto;display:flex;gap:8px">
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-o btn-sm" style="flex:1;justify-content:center">Details</a>
              @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product->id) }}" style="flex:1">
                  @csrf
                  <button type="submit" class="btn btn-p btn-sm btn-fw">Add to Cart</button>
                </form>
              @else
                <button class="btn btn-s btn-sm" style="flex:1;cursor:not-allowed;opacity:.6" disabled>Out of Stock</button>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif

</div>

@endsection
