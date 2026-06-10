@extends('layouts.app')
@section('title', 'TechShop — Premium Electronics Store')

@section('content')

{{-- HERO --}}
<section class="hero">
  <div class="container">
    <div class="hero-grid">

      {{-- Left: text --}}
      <div>
        <div class="hero-eye">
          <span class="hero-dot"></span>
          New Arrivals 2024
        </div>
        <h1 class="hero-title">
          Discover the<br>
          <span class="text-grad">Future of Tech</span>
        </h1>
        <p class="hero-desc">
          Shop the latest smartphones, laptops, audio gear, gaming consoles, and smart devices — all in one place, with free fast delivery.
        </p>
        <div class="hero-ctas">
          <a href="{{ route('products') }}" class="btn btn-p btn-lg">Shop Now</a>
          <a href="{{ route('categories') }}" class="btn btn-o btn-lg">Browse Categories</a>
        </div>
        <div class="hero-stats">
          <div>
            <div class="stat-val">{{ \App\Models\Product::count() }}+</div>
            <div class="stat-lbl">Products</div>
          </div>
          <div>
            <div class="stat-val">{{ \App\Models\Category::count() }}</div>
            <div class="stat-lbl">Categories</div>
          </div>
          <div>
            <div class="stat-val">24h</div>
            <div class="stat-lbl">Fast Delivery</div>
          </div>
          <div>
            <div class="stat-val">2yr</div>
            <div class="stat-lbl">Warranty</div>
          </div>
        </div>
      </div>

      {{-- Right: product mosaic --}}
      <div class="hero-vis">
        <div class="hero-vis-grid">
          @foreach($featuredProducts->take(4) as $p)
            <a href="{{ route('products.show', $p->id) }}" class="hero-vc">
              @if($p->image)
                <img src="{{ $p->image }}" alt="{{ $p->title }}" loading="lazy">
              @else
                <div style="width:100%;aspect-ratio:4/3;background:var(--sf2);display:flex;align-items:center;justify-content:center;color:var(--tx3);">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                </div>
              @endif
            </a>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- FEATURES STRIP --}}
<div style="background:var(--sf);border-bottom:1px solid var(--bd);padding:16px 0;">
  <div class="container">
    <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:24px 40px;">
      @foreach([
        ['icon'=>'M5 13l4 4L19 7','label'=>'Free Shipping over $99'],
        ['icon'=>'M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z','label'=>'2-Year Warranty'],
        ['icon'=>'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z','label'=>'24/7 Support'],
        ['icon'=>'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15','label'=>'Easy Returns'],
      ] as $f)
      <div style="display:flex;align-items:center;gap:9px;font-size:.875rem;font-weight:600;color:var(--tx2);">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--p)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $f['icon'] }}"/></svg>
        {{ $f['label'] }}
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- CATEGORIES --}}
<section class="section">
  <div class="container">
    <div class="sec-head flex-bet flex-wrap gap-3">
      <div>
        <h2>Shop by <span class="text-grad">Category</span></h2>
        <p>Find exactly what you're looking for</p>
      </div>
      <a href="{{ route('categories') }}" class="btn btn-o">View All</a>
    </div>

    <div class="g4" style="grid-template-columns:repeat(auto-fill,minmax(200px,1fr))">
      @forelse($categories as $cat)
        <a href="{{ route('products', ['category' => $cat->id]) }}" class="cat-card">
          @if($cat->image)
            <img src="{{ $cat->image }}" alt="{{ $cat->name }}" loading="lazy">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--p),#9B85FF)"></div>
          @endif
          <div class="cat-ov"></div>
          <div class="cat-body">
            <div class="cat-cnt">{{ $cat->products_count }} products</div>
            <div class="cat-name">{{ $cat->name }}</div>
          </div>
          <div class="cat-arr">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </div>
        </a>
      @empty
        <p class="text-muted">No categories yet.</p>
      @endforelse
    </div>
  </div>
</section>

{{-- FEATURED PRODUCTS --}}
<section class="section" style="padding-top:0;background:var(--sf2)">
  <div class="container" style="padding-top:56px">
    <div class="sec-head flex-bet flex-wrap gap-3">
      <div>
        <h2>Featured <span class="text-grad">Products</span></h2>
        <p>Hand-picked top sellers and new arrivals</p>
      </div>
      <a href="{{ route('products') }}" class="btn btn-o">View All Products</a>
    </div>

    @if($featuredProducts->isEmpty())
      <div class="empty">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/></svg>
        <h3>No products yet</h3>
        <p>Check back soon for new arrivals.</p>
      </div>
    @else
      <div class="prod-grid">
        @foreach($featuredProducts as $product)
          <div class="card" style="display:flex;flex-direction:column">
            <a href="{{ route('products.show', $product->id) }}">
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
              <div class="card-stock {{ $product->stock < 10 ? 'low' : '' }}">
                {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
              </div>
              <div style="margin-top:auto">
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                  @csrf
                  <button type="submit" class="btn btn-p btn-fw">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                    Add to Cart
                  </button>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</section>

{{-- WHY TECHSHOP --}}
<section class="section">
  <div class="container">
    <div class="sec-head center">
      <h2>Why Choose <span class="text-grad">TechShop</span></h2>
      <p>We're committed to delivering the best tech shopping experience</p>
    </div>
    <div class="g4">
      @foreach([
        ['color'=>'ico-blue','icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','title'=>'Genuine Products','desc'=>'Every product is 100% authentic with official manufacturer warranty.'],
        ['color'=>'ico-cyan','icon'=>'M13 10V3L4 14h7v7l9-11h-7z','title'=>'Fast Delivery','desc'=>'Same-day dispatch on orders placed before 2 PM. Nationwide coverage.'],
        ['color'=>'ico-green','icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z','title'=>'Secure Payments','desc'=>'Bank-level encryption protects every transaction you make with us.'],
        ['color'=>'ico-amber','icon'=>'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15','title'=>'Easy Returns','desc'=>'Not happy? Return within 30 days for a full refund, no questions asked.'],
      ] as $f)
        <div class="feat-card">
          <div class="feat-icon {{ $f['color'] }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $f['icon'] }}"/></svg>
          </div>
          <h4>{{ $f['title'] }}</h4>
          <p>{{ $f['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- CTA BANNER --}}
<section style="padding:0 0 80px">
  <div class="container">
    <div style="background:linear-gradient(135deg,var(--p) 0%,#9B85FF 50%,var(--cyan) 100%);border-radius:24px;padding:56px 48px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:24px;position:relative;overflow:hidden;">
      <div style="position:absolute;inset:0;background:radial-gradient(circle at 80% 50%,rgba(255,255,255,.12) 0%,transparent 60%);pointer-events:none;"></div>
      <div style="position:relative;z-index:1;max-width:480px">
        <div style="font-size:.78rem;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.08em;margin-bottom:10px">Limited Time Offer</div>
        <h2 style="color:#fff;margin-bottom:10px;">Up to <span style="text-decoration:underline;text-decoration-color:rgba(255,255,255,.4);">40% Off</span> on<br>Select Electronics</h2>
        <p style="color:rgba(255,255,255,.8);font-size:1rem;margin-bottom:0">Don't miss our best deals. New offers added weekly.</p>
      </div>
      <div style="display:flex;gap:12px;flex-wrap:wrap;position:relative;z-index:1">
        <a href="{{ route('products') }}" class="btn" style="background:#fff;color:var(--p);font-weight:700;padding:13px 28px;border-radius:999px;">Shop the Sale</a>
        @guest
          <a href="{{ route('register') }}" class="btn btn-ghost-white btn-lg">Create Account</a>
        @endguest
      </div>
    </div>
  </div>
</section>

@endsection
