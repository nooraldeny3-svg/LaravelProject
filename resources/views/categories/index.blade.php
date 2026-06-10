@extends('layouts.app')
@section('title', 'Categories — TechShop')

@section('content')

<div class="pg-head">
  <div class="container">
    <div class="pg-head-inner">
      <h1>Shop by Category</h1>
      <p class="pg-sub">Browse our {{ $categories->count() }} product categories</p>
    </div>
  </div>
</div>

<div class="container" style="padding-bottom:80px">

  @if($categories->isEmpty())
    <div class="empty">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      <h3>No categories yet</h3>
      <p>Categories will appear here once added.</p>
    </div>
  @else
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:28px">
      @foreach($categories as $cat)
        <a href="{{ route('products', ['category' => $cat->id]) }}" class="cat-card" style="aspect-ratio:16/9">
          @if($cat->image)
            <img src="{{ $cat->image }}" alt="{{ $cat->name }}" loading="lazy">
          @else
            <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--p),#9B85FF)"></div>
          @endif
          <div class="cat-ov"></div>
          <div class="cat-body">
            <div class="cat-cnt">{{ $cat->products_count }} product(s)</div>
            <div class="cat-name">{{ $cat->name }}</div>
            @if($cat->description)
              <div style="font-size:.8rem;opacity:.75;margin-top:5px;line-height:1.5">{{ Str::limit($cat->description, 70) }}</div>
            @endif
          </div>
          <div class="cat-arr">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </div>
        </a>
      @endforeach
    </div>
  @endif

</div>

@endsection
