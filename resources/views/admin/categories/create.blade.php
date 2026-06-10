@extends('layouts.app')
@section('title', 'Add Category — Admin')

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
    <a href="{{ route('admin.categories.index') }}" class="pg-back" style="display:inline-flex;margin-bottom:20px">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
      Categories
    </a>
    <h1 style="font-size:1.75rem;margin-bottom:28px">Add New Category</h1>

    @if($errors->any())
      <div style="background:var(--err-bg);border:1px solid rgba(239,68,68,.25);border-radius:var(--r3);padding:14px 18px;margin-bottom:22px">
        <ul style="padding-left:18px;font-size:.84rem;color:var(--err)">
          @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
      </div>
    @endif

    <div style="max-width:600px;background:var(--sf);border:1px solid var(--bd);border-radius:var(--r4);padding:32px">
      <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="fg">
          <label class="fl" for="name">Category Name <span>*</span></label>
          <input type="text" id="name" name="name" class="fi" value="{{ old('name') }}" required placeholder="e.g. Smartphones">
          @error('name')<div class="fe">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
          <label class="fl" for="description">Description</label>
          <textarea id="description" name="description" class="ft" rows="3" placeholder="Brief description of this category...">{{ old('description') }}</textarea>
          @error('description')<div class="fe">{{ $message }}</div>@enderror
        </div>

        <div class="fg">
          <label class="fl" for="image">Image URL</label>
          <input type="url" id="image" name="image" class="fi" value="{{ old('image') }}" placeholder="https://...">
          <div class="fh">Direct image URL for the category card.</div>
          @error('image')<div class="fe">{{ $message }}</div>@enderror
        </div>

        <div id="imgPreviewWrap" style="display:none;margin-bottom:18px">
          <img id="imgPreview" src="" alt="Preview" style="max-height:140px;border-radius:var(--r3);border:1px solid var(--bd);object-fit:cover">
        </div>

        <div style="display:flex;gap:10px">
          <button type="submit" class="btn btn-p">Save Category</button>
          <a href="{{ route('admin.categories.index') }}" class="btn btn-o">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
var imgInput=document.getElementById('image'),imgWrap=document.getElementById('imgPreviewWrap'),imgPrev=document.getElementById('imgPreview');
imgInput.addEventListener('input',function(){var v=this.value.trim();if(v){imgPrev.src=v;imgWrap.style.display='block'}else{imgWrap.style.display='none'}});
</script>
@endsection
