@extends('layouts.app')
@section('title', 'All Orders — Admin')

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
    <a href="{{ route('admin.categories.index') }}" class="adm-nav-item">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 01-2 2H4a2 2 0 01-2-2V5a2 2 0 012-2h5l2 3h9a2 2 0 012 2z"/></svg>
      Categories
    </a>
    <div class="adm-nav-lbl">Sales</div>
    <a href="{{ route('admin.orders.index') }}" class="adm-nav-item on">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
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
        <h1 style="font-size:1.75rem">All Orders</h1>
        <p style="margin-top:4px">{{ $orders->count() }} total order(s)</p>
      </div>
    </div>

    @if($orders->isEmpty())
      <div class="empty"><h3>No orders yet</h3><p>Customer orders will appear here.</p></div>
    @else
      <div class="tw">
        <table class="table">
          <thead>
            <tr>
              <th>Order</th>
              <th>Customer</th>
              <th>Email</th>
              <th>Total</th>
              <th>Delivery Date</th>
              <th>Status</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
              <tr>
                <td><strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong></td>
                <td>{{ $order->customer_name }}</td>
                <td style="color:var(--tx3)">{{ $order->user->email ?? '—' }}</td>
                <td style="font-weight:700;color:var(--p)">${{ number_format($order->total_price, 2) }}</td>
                <td style="color:var(--tx2)">
                  @if($order->delivery_date) {{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }} @else — @endif
                </td>
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

@endsection
