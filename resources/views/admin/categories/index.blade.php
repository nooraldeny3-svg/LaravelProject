@extends('layouts.app')
@section('title', 'Manage Categories — Admin')

@section('content')

<div class="adm-layout">
  <aside class="adm-side">
    <div class="adm-nav-lbl">Overview</div>
    <a href="{{ route('admin.home') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Dashboard
    </a>
    <div class="adm-nav-lbl">Catalog</div>
    <a href="{{ route('admin.products.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
      Products
    </a>
    <a href="{{ route('admin.categories.index') }}" class="adm-nav-item on">
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
        <h1 style="font-size:1.75rem">Categories</h1>
        <p style="margin-top:4px">{{ $categories->count() }} category(s)</p>
      </div>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-p">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Category
      </a>
    </div>

    @if($categories->isEmpty())
      <div class="empty"><h3>No categories yet</h3><p>Add your first category to organise your products.</p>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-p">Add Category</a>
      </div>
    @else
      <div class="tw">
        <table class="table">
          <thead>
            <tr>
              <th>Category</th>
              <th>Description</th>
              <th>Products</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $cat)
              <tr>
                <td>
                  <div style="display:flex;align-items:center;gap:12px">
                    @if($cat->image)
                      <img src="{{ $cat->image }}" class="tthumb" alt="{{ $cat->name }}">
                    @else
                      <div class="tthumb" style="display:flex;align-items:center;justify-content:center;background:var(--sf2);color:var(--tx3)">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
                      </div>
                    @endif
                    <span style="font-weight:600;color:var(--tx)">{{ $cat->name }}</span>
                  </div>
                </td>
                <td style="max-width:280px;color:var(--tx3)">{{ Str::limit($cat->description, 70) }}</td>
                <td><span class="badge badge-p">{{ $cat->products_count }}</span></td>
                <td>
                  <div style="display:flex;gap:6px">
                    <a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-o btn-sm">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}" onsubmit="return confirm('Delete this category? All its products will also be deleted.')">
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
