@extends('layouts.app')
@section('title', 'My Orders — TechShop')

@section('content')

<div class="pg-head">
  <div class="container">
    <div class="pg-head-inner">
      <h1>My Orders</h1>
      <p class="pg-sub">Track and manage your purchases</p>
    </div>
  </div>
</div>

<div class="container" style="padding-bottom:80px">

  <div class="flex-bet flex-wrap gap-3" style="margin-bottom:24px">
    <p class="text-muted">{{ $orders->count() }} order(s) found</p>
    <a href="{{ route('products') }}" class="btn btn-p btn-sm">+ Shop More</a>
  </div>

  @if($orders->isEmpty())
    <div class="empty">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      <h3>No orders yet</h3>
      <p>When you place an order, it will appear here.</p>
      <a href="{{ route('products') }}" class="btn btn-p">Start Shopping</a>
    </div>
  @else
    <div style="display:flex;flex-direction:column;gap:14px">
      @foreach($orders as $order)
        <div style="background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);overflow:hidden;transition:box-shadow var(--t2);box-shadow:var(--s1)" onmouseenter="this.style.boxShadow='var(--s3)'" onmouseleave="this.style.boxShadow='var(--s1)'">

          {{-- Header --}}
          <div style="display:flex;justify-content:space-between;align-items:center;padding:16px 22px;border-bottom:1px solid var(--bd);flex-wrap:wrap;gap:10px">
            <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
              <div>
                <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:3px">Order</div>
                <div style="font-weight:800;font-size:1rem">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
              </div>
              <div>
                <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:3px">Placed</div>
                <div style="font-weight:600;font-size:.9rem">{{ $order->created_at->format('d M Y') }}</div>
              </div>
              <div>
                <div style="font-size:.72rem;font-weight:700;color:var(--tx3);text-transform:uppercase;letter-spacing:.06em;margin-bottom:3px">Items</div>
                <div style="font-weight:600;font-size:.9rem">{{ $order->orderItems->count() }} product(s)</div>
              </div>
            </div>
            <div style="display:flex;align-items:center;gap:14px">
              <div style="font-size:1.4rem;font-weight:900;color:var(--p)">${{ number_format($order->total_price, 2) }}</div>
              @if($order->status === 'confirmed')
                <span class="badge badge-conf">Confirmed</span>
              @elseif($order->status === 'cancelled')
                <span class="badge badge-canc">Cancelled</span>
              @else
                <span class="badge badge-pend">Pending</span>
              @endif
            </div>
          </div>

          {{-- Body --}}
          <div style="padding:14px 22px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
            <div style="font-size:.875rem;color:var(--tx3)">
              @if($order->delivery_date)
                Preferred delivery: <strong style="color:var(--tx2)">{{ \Carbon\Carbon::parse($order->delivery_date)->format('d M Y') }}</strong>
              @endif
              @if($order->shipping_address)
                &bull; Shipping to: <strong style="color:var(--tx2)">{{ Str::limit($order->shipping_address, 40) }}</strong>
              @endif
            </div>
            @if($order->status === 'pending')
              <div style="font-size:.8rem;color:var(--warn);display:flex;align-items:center;gap:5px">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                Awaiting confirmation
              </div>
            @elseif($order->status === 'confirmed')
              <div style="font-size:.8rem;color:var(--ok);display:flex;align-items:center;gap:5px">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                Order confirmed &amp; processing
              </div>
            @endif
          </div>

        </div>
      @endforeach
    </div>

    <div style="background:var(--sf2);border:1px solid var(--bd);border-radius:var(--r3);padding:14px 18px;margin-top:20px;font-size:.875rem;color:var(--tx3);display:flex;align-items:center;gap:10px">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--p)" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      Pending orders will be confirmed within 24 hours. We'll contact you by phone to arrange payment.
    </div>
  @endif

</div>

@endsection
