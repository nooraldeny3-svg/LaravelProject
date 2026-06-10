<x-guest-layout>
<div class="auth-wrap">
  <div class="auth-card">
    <div class="auth-logo">
      <a href="{{ route('home') }}">Tech<span>Shop</span></a>
    </div>
    <div class="auth-ttl">
      <h2>Create Account</h2>
      <p>Join TechShop for exclusive deals and fast checkout</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="fg">
        <label class="fl" for="name">Full Name <span>*</span></label>
        <input type="text" id="name" name="name" class="fi" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Smith">
        @error('name')<div class="fe">{{ $message }}</div>@enderror
      </div>

      <div class="fg">
        <label class="fl" for="email">Email Address <span>*</span></label>
        <input type="email" id="email" name="email" class="fi" value="{{ old('email') }}" required autocomplete="email" placeholder="you@example.com">
        @error('email')<div class="fe">{{ $message }}</div>@enderror
      </div>

      <div class="fg">
        <label class="fl" for="password">Password <span>*</span></label>
        <input type="password" id="password" name="password" class="fi" required autocomplete="new-password" placeholder="Min. 8 characters">
        @error('password')<div class="fe">{{ $message }}</div>@enderror
      </div>

      <div class="fg" style="margin-bottom:22px">
        <label class="fl" for="password_confirmation">Confirm Password <span>*</span></label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="fi" required autocomplete="new-password" placeholder="Repeat password">
        @error('password_confirmation')<div class="fe">{{ $message }}</div>@enderror
      </div>

      <button type="submit" class="btn btn-p btn-fw btn-lg">Create Account</button>
    </form>

    <div class="auth-foot">
      Already have an account? <a href="{{ route('login') }}">Sign in</a>
    </div>
  </div>
</div>
</x-guest-layout>
