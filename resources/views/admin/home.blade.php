@extends('layouts.app')
@section('title', 'Admin Dashboard — TechShop')

@section('content')

<div class="adm-layout">

  {{-- Sidebar --}}
  <aside class="adm-side">
    <div class="adm-nav-lbl">Overview</div>
    <a href="{{ route('admin.home') }}" class="adm-nav-item on">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Dashboard
    </a>
    <div class="adm-nav-lbl">Catalog</div>
    <a href="{{ route('admin.products.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/></svg>
      Products
    </a>
    <a href="{{ route('admin.categories.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
      Categories
    </a>
    <div class="adm-nav-lbl">Sales</div>
    <a href="{{ route('admin.orders.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      Orders
    </a>
    <hr class="divider">
    <a href="{{ route('home') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
      Back to Store
    </a>
  </aside>

  {{-- Content --}}
  <div class="adm-content">

    {{-- Header --}}
    <div style="margin-bottom:32px">
      <h1 style="font-size:1.75rem">Dashboard</h1>
      <p style="margin-top:4px">Welcome back, <strong style="color:var(--tx)">{{ auth()->user()->name }}</strong></p>
    </div>

    {{-- Stat Cards --}}
    <div class="g4" style="margin-bottom:36px">
      <div class="stat-card">
        <div class="stat-ico ico-blue">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
        </div>
        <div>
          <div class="stat-num">{{ $totalProducts }}</div>
          <div class="stat-txt">Total Products</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-ico ico-cyan">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
        </div>
        <div>
          <div class="stat-num">{{ $totalCategories }}</div>
          <div class="stat-txt">Categories</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-ico ico-amber">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
        </div>
        <div>
          <div class="stat-num">{{ $totalOrders }}</div>
          <div class="stat-txt">Total Orders</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-ico ico-green">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
        </div>
        <div>
          <div class="stat-num">${{ number_format($totalRevenue, 0) }}</div>
          <div class="stat-txt">Revenue (Confirmed)</div>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px">
      <a href="{{ route('admin.products.create') }}" class="btn btn-p">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Product
      </a>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-o">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Add Category
      </a>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-s">View All Orders</a>
    </div>

    {{-- Recent Orders --}}
    <div>
      <div class="flex-bet" style="margin-bottom:16px">
        <h3>Recent Orders</h3>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-o btn-sm">View All</a>
      </div>

      @if($recentOrders->isEmpty())
        <div class="empty" style="padding:40px 0">
          <h4>No orders yet</h4>
          <p>Orders will appear here once customers start buying.</p>
        </div>
      @else
        <div class="tw">
          <table class="table">
            <thead>
              <tr>
                <th>Order</th>
                <th>Customer</th>
                <th>Email</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentOrders as $order)
                <tr>
                  <td><strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                  <td>{{ $order->customer_name }}</td>
                  <td style="color:var(--tx3)">{{ $order->user->email ?? '—' }}</td>
                  <td style="font-weight:700;color:var(--p)">${{ number_format($order->total_price, 2) }}</td>
                  <td>
                    @if($order->status === 'confirmed') <span class="badge badge-conf">Confirmed</span>
                    @elseif($order->status === 'cancelled') <span class="badge badge-canc">Cancelled</span>
                    @else <span class="badge badge-pend">Pending</span>
                    @endif
                  </td>
                  <td style="color:var(--tx3)">{{ $order->created_at->format('d M Y') }}</td>
                  <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-o btn-sm">View</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

  </div>
</div>

@endsection
