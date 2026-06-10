@extends('layouts.app')
@section('title', 'Edit Product — Admin')

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
    <a href="{{ route('admin.products.index') }}" class="pg-back" style="display:inline-flex;margin-bottom:20px">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
      Products
    </a>
    <h1 style="font-size:1.75rem;margin-bottom:4px">Edit Product</h1>
    <p style="margin-bottom:28px;color:var(--tx3)">{{ $product->title }}</p>

    @if($errors->any())
      <div style="background:var(--err-bg);border:1px solid rgba(239,68,68,.25);border-radius:var(--r3);padding:14px 18px;margin-bottom:22px">
        <p style="font-weight:600;font-size:.9rem;color:var(--err);margin-bottom:6px">Please fix these errors:</p>
        <ul style="padding-left:18px;font-size:.84rem;color:var(--err)">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <div style="max-width:720px;background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:32px">
      <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf @method('PUT')

        <div class="fr">
          <div class="fg">
            <label class="fl" for="title">Product Name <span>*</span></label>
            <input type="text" id="title" name="title" class="fi" value="{{ old('title', $product->title) }}" required>
            @error('title')<div class="fe">{{ $message }}</div>@enderror
          </div>
          <div class="fg">
            <label class="fl" for="brand">Brand</label>
            <input type="text" id="brand" name="brand" class="fi" value="{{ old('brand', $product->brand) }}" placeholder="e.g. Apple">
            @error('brand')<div class="fe">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="fg">
          <label class="fl" for="category_id">Category <span>*</span></label>
          <select id="category_id" name="category_id" class="fs" required>
            <option value="">— Select Category —</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
          </select>
          @error('category_id')<div class="fe">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
          <label class="fl" for="description">Description <span>*</span></label>
          <textarea id="description" name="description" class="ft" required rows="4">{{ old('description', $product->description) }}</textarea>
          @error('description')<div class="fe">{{ $message }}</div>@enderror
        </div>

        <div class="fr">
          <div class="fg">
            <label class="fl" for="price">Price (USD) <span>*</span></label>
            <input type="number" id="price" name="price" class="fi" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
            @error('price')<div class="fe">{{ $message }}</div>@enderror
          </div>
          <div class="fg">
            <label class="fl" for="stock">Stock Quantity <span>*</span></label>
            <input type="number" id="stock" name="stock" class="fi" value="{{ old('stock', $product->stock) }}" min="0" required>
            @error('stock')<div class="fe">{{ $message }}</div>@enderror
          </div>
        </div>

        <div class="fg">
          <label class="fl" for="image">Image URL</label>
          <input type="url" id="image" name="image" class="fi" value="{{ old('image', $product->image) }}">
          @error('image')<div class="fe">{{ $message }}</div>@enderror
        </div>

        <div id="imgPreviewWrap" style="{{ $product->image ? '' : 'display:none;' }}margin-bottom:18px">
          <img id="imgPreview" src="{{ $product->image }}" alt="Preview" style="max-height:160px;border-radius:var(--r3);border:1px solid var(--bd);object-fit:cover">
        </div>

        <div class="fg">
          <label class="tog-label">
            <input type="checkbox" name="is_available" value="1" {{ old('is_available', $product->is_available) ? 'checked' : '' }} class="sr-only">
            <div class="tog-track"></div>
            <span style="font-weight:600">Available for purchase</span>
          </label>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px;flex-wrap:wrap">
          <button type="submit" class="btn btn-p">Save Changes</button>
          <a href="{{ route('admin.products.index') }}" class="btn btn-o">Cancel</a>
          <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Delete this product?')" style="margin-left:auto">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-d">Delete Product</button>
          </form>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
var imgInput=document.getElementById('image'),imgWrap=document.getElementById('imgPreviewWrap'),imgPrev=document.getElementById('imgPreview');
imgInput.addEventListener('input',function(){
  var v=this.value.trim();
  if(v){imgPrev.src=v;imgWrap.style.display='block'}else{imgWrap.style.display='none'}
});
</script>
@endsection
