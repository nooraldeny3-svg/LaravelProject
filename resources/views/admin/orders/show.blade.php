@extends('layouts.app')
@section('title', 'Order #' . str_pad($order->id, 6, '0', STR_PAD_LEFT) . ' — Admin')

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

    <a href="{{ route('admin.orders.index') }}" class="pg-back" style="display:inline-flex;margin-bottom:20px">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
      All Orders
    </a>

    <div class="flex-bet flex-wrap gap-3" style="margin-bottom:28px">
      <div>
        <h1 style="font-size:1.75rem">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h1>
        <p style="margin-top:4px">Placed on {{ $order->created_at->format('d F Y, H:i') }}</p>
      </div>
      @if($order->status === 'confirmed') <span class="badge badge-conf" style="font-size:.9rem;padding:8px 16px">Confirmed</span>
      @elseif($order->status === 'cancelled') <span class="badge badge-canc" style="font-size:.9rem;padding:8px 16px">Cancelled</span>
      @else <span class="badge badge-pend" style="font-size:.9rem;padding:8px 16px">Pending</span>
      @endif
    </div>

    <div style="display:grid;grid-template-columns:1fr 340px;gap:24px;align-items:start">

      {{-- Left: details --}}
      <div style="display:flex;flex-direction:column;gap:20px">

        {{-- Customer Info --}}
        <div style="background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:24px">
          <h4 style="margin-bottom:18px">Customer Information</h4>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
            @foreach([
              ['label'=>'Name','value'=>$order->customer_name],
              ['label'=>'Email','value'=>$order->user->email ?? '—'],
              ['label'=>'Phone','value'=>$order->customer_phone],
              ['label'=>'Order Date','value'=>$order->created_at->format('d M Y')],
            ] as $r)
              <div>
                <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:3px">{{ $r['label'] }}</div>
                <div style="font-weight:600">{{ $r['value'] }}</div>
              </div>
            @endforeach
          </div>
          @if($order->shipping_address)
            <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--bd)">
              <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:5px">Shipping Address</div>
              <div style="font-weight:500">{{ $order->shipping_address }}</div>
            </div>
          @endif
          @if($order->delivery_date)
            <div style="margin-top:14px;padding-top:14px;border-top:1px solid var(--bd)">
              <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:5px">Preferred Delivery Date</div>
              <div style="font-weight:600;color:var(--p)">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d F Y') }}</div>
            </div>
          @endif
        </div>

        {{-- Order Items --}}
        <div style="background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);overflow:hidden">
          <div style="padding:18px 22px;border-bottom:1px solid var(--bd)"><h4>Order Items</h4></div>
          @foreach($order->orderItems as $item)
            <div style="display:flex;align-items:center;gap:14px;padding:16px 22px;border-bottom:1px solid var(--bd)">
              @if($item->product->image)
                <img src="{{ $item->product->image }}" alt="{{ $item->product->title }}" style="width:56px;height:56px;border-radius:var(--r2);object-fit:cover;border:1px solid var(--bd)">
              @else
                <div style="width:56px;height:56px;border-radius:var(--r2);background:var(--sf2);display:flex;align-items:center;justify-content:center;color:var(--tx3);border:1px solid var(--bd)">
                  <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/></svg>
                </div>
              @endif
              <div style="flex:1">
                <div style="font-weight:600">{{ $item->product->title }}</div>
                <div style="font-size:.84rem;color:var(--tx3);margin-top:2px">{{ $item->quantity }} &times; ${{ number_format($item->price, 2) }}</div>
              </div>
              <div style="font-weight:700;color:var(--p)">${{ number_format($item->price * $item->quantity, 2) }}</div>
            </div>
          @endforeach
          <div style="padding:16px 22px;display:flex;justify-content:space-between;align-items:center">
            <span style="font-weight:700">Total</span>
            <span style="font-size:1.4rem;font-weight:900;color:var(--p)">${{ number_format($order->total_price, 2) }}</span>
          </div>
        </div>
      </div>

      {{-- Right: status --}}
      <div>
        <div style="background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:24px;position:sticky;top:calc(var(--nav-h) + 18px)">
          <h4 style="margin-bottom:18px">Update Status</h4>
          <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
            @csrf @method('PATCH')
            <div class="fg">
              <label class="fl">Order Status</label>
              <select name="status" class="fs">
                <option value="pending"   {{ $order->status === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>
            <button type="submit" class="btn btn-p btn-fw">Update Status</button>
          </form>

          <hr class="divider">
          <div style="font-size:.84rem;color:var(--tx3);display:flex;flex-direction:column;gap:8px">
            <div class="flex-bet"><span>Items</span><strong style="color:var(--tx)">{{ $order->orderItems->count() }}</strong></div>
            <div class="flex-bet"><span>Order Total</span><strong style="color:var(--p)">${{ number_format($order->total_price, 2) }}</strong></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@endsection
