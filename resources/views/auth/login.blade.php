<x-guest-layout>
<div class="auth-wrap">
  <div class="auth-card">
    <div class="auth-logo">
      <a href="{{ route('home') }}">Tech<span>Shop</span></a>
    </div>
    <div class="auth-ttl">
      <h2>Welcome back</h2>
      <p>Sign in to your account to continue</p>
    </div>

    @if (session('status'))
      <div style="background:var(--ok-bg);border:1px solid rgba(16,185,129,.2);border-radius:var(--r2);padding:11px 14px;margin-bottom:18px;font-size:.9rem;color:var(--ok)">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="fg">
        <label class="fl" for="email">Email Address <span>*</span></label>
        <input type="email" id="email" name="email" class="fi" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="you@example.com">
        @error('email')<div class="fe">{{ $message }}</div>@enderror
      </div>

      <div class="fg">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:7px">
          <label class="fl" for="password" style="margin-bottom:0">Password <span>*</span></label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" style="font-size:.84rem;color:var(--p);font-weight:600">Forgot password?</a>
          @endif
        </div>
        <input type="password" id="password" name="password" class="fi" required autocomplete="current-password" placeholder="••••••••">
        @error('password')<div class="fe">{{ $message }}</div>@enderror
      </div>

      <div class="fg" style="margin-bottom:22px">
        <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:.9375rem">
          <input type="checkbox" name="remember" style="width:16px;height:16px;accent-color:var(--p)">
          Remember me
        </label>
      </div>

      <button type="submit" class="btn btn-p btn-fw btn-lg">Sign In</button>
    </form>

    <div class="auth-foot">
      Don't have an account? <a href="{{ route('register') }}">Create one free</a>
    </div>
  </div>
</div>
</x-guest-layout>
