@extends('layouts.app')
@section('title', 'Manage Products — Admin')

@section('content')

<div class="adm-layout">
  <aside class="adm-side">
    <div class="adm-nav-lbl">Overview</div>
    <a href="{{ route('admin.home') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Dashboard
    </a>
    <div class="adm-nav-lbl">Catalog</div>
    <a href="{{ route('admin.products.index') }}" class="adm-nav-item on">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
      Products
    </a>
    <a href="{{ route('admin.categories.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
      Categories
    </a>
    <div class="adm-nav-lbl">Sales</div>
    <a href="{{ route('admin.orders.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
      Orders
    </a>
    <hr class="divider">
    <a href="{{ route('home') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
      Back to Store
    </a>
  </aside>

  <div class="adm-content">
    <div class="flex-bet flex-wrap gap-3" style="margin-bottom:28px">
      <div>
        <h1 style="font-size:1.75rem">Products</h1>
        <p style="margin-top:4px">{{ $products->count() }} product(s) in catalog</p>
      </div>
      <a href="{{ route('admin.products.create') }}" class="btn btn-p">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Product
      </a>
    </div>

    @if($products->isEmpty())
      <div class="empty"><h3>No products yet</h3><p>Add your first product to start selling.</p>
        <a href="{{ route('admin.products.create') }}" class="btn btn-p">Add Product</a>
      </div>
    @else
      <div class="tw">
        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Brand</th>
              <th>Category</th>
              <th>Price</th>
              <th>Stock</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $product)
              <tr>
                <td>
                  <div style="display:flex;align-items:center;gap:12px">
                    @if($product->image)
                      <img src="{{ $product->image }}" class="tthumb" alt="{{ $product->title }}">
                    @else
                      <div class="tthumb" style="display:flex;align-items:center;justify-content:center;background:var(--sf2);color:var(--tx3)">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
                      </div>
                    @endif
                    <div>
                      <div style="font-weight:600;color:var(--tx)">{{ Str::limit($product->title, 36) }}</div>
                      <div style="font-size:.78rem;color:var(--tx3)">#{{ $product->id }}</div>
                    </div>
                  </div>
                </td>
                <td>{{ $product->brand ?? '—' }}</td>
                <td>
                  @if($product->category)
                    <span class="badge badge-p">{{ $product->category->name }}</span>
                  @else —
                  @endif
                </td>
                <td style="font-weight:700;color:var(--p)">${{ number_format($product->price, 2) }}</td>
                <td>
                  <span style="color:{{ $product->stock === 0 ? 'var(--err)' : ($product->stock < 10 ? 'var(--warn)' : 'var(--ok)') }};font-weight:600">
                    {{ $product->stock }}
                  </span>
                </td>
                <td>
                  @if($product->is_available)
                    <span class="badge badge-conf">Active</span>
                  @else
                    <span class="badge badge-canc">Hidden</span>
                  @endif
                </td>
                <td>
                  <div style="display:flex;gap:6px">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-o btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Delete this product?')">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-d btn-sm">Delete</button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>

@endsection
