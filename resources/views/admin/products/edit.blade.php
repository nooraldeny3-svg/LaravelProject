@extends('layouts.app')
@section('title', 'Edit Tour — Admin')

@section('styles')
<style>
    .form-wrap { max-width: 720px; margin: 0 auto; padding: 2.5rem 0 3rem; }
    .price-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem; }
    .price-input-wrap { display: flex; }
    .price-prefix {
        background: #f8fafc;
        border: 1.5px solid var(--border);
        border-right: none;
        border-radius: 6px 0 0 6px;
        padding: 0.68rem 0.88rem;
        font-weight: 600;
        color: var(--gray);
        font-size: 0.88rem;
    }
    .price-prefix + .form-input { border-radius: 0 6px 6px 0; }
    .toggle-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 6px;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .toggle-row:hover { border-color: var(--red); }
    .form-actions { display: flex; gap: 0.8rem; margin-top: 2rem; }
    .errors-box { background: #fee2e2; border-left: 4px solid var(--red); border-radius: 6px; padding: 0.9rem 1.1rem; margin-bottom: 1.4rem; }
    .errors-box ul { padding-left: 1.2rem; font-size: 0.83rem; color: #b91c1c; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Admin Panel</div>
        <h1 class="section-title" style="color:white;">Edit Tour</h1>
        <p style="color:rgba(255,255,255,0.58);margin-top:0.35rem;font-size:0.88rem;">{{ $product->title }}</p>
    </div>
</div>

<div class="container">
    <div class="form-wrap">
        <div style="margin-bottom:1rem;">
            <a href="{{ route('admin.products.index') }}" style="font-size:0.83rem;color:var(--gray);font-weight:500;">&larr; All Tours</a>
        </div>

        <div class="form-card">
            <div class="form-card-header">Edit Tour Information</div>
            <div class="form-card-body">

                @if($errors->any())
                    <div class="errors-box">
                        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">City <span style="color:var(--red);">*</span></label>
                        <select name="category_id" class="form-input @error('category_id') is-invalid @enderror" required>
                            <option value="">— Select a city —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tour Title <span style="color:var(--red);">*</span></label>
                        <input type="text" name="title" class="form-input @error('title') is-invalid @enderror"
                               value="{{ old('title', $product->title) }}" required>
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description <span style="color:var(--red);">*</span></label>
                        <textarea name="description" rows="4" class="form-input @error('description') is-invalid @enderror" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="price-row">
                        <div>
                            <label class="form-label" style="margin-bottom:0.38rem;display:block;">Price (USD) <span style="color:var(--red);">*</span></label>
                            <div class="price-input-wrap">
                                <span class="price-prefix">$</span>
                                <input type="number" name="price" class="form-input @error('price') is-invalid @enderror"
                                       value="{{ old('price', $product->price) }}" min="0" step="0.01" required>
                            </div>
                            @error('price')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="form-label" style="margin-bottom:0.38rem;display:block;">Duration (days) <span style="color:var(--red);">*</span></label>
                            <input type="number" name="duration_days" class="form-input @error('duration_days') is-invalid @enderror"
                                   value="{{ old('duration_days', $product->duration_days) }}" min="1" required>
                            @error('duration_days')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Image URL <span style="color:var(--gray);text-transform:none;letter-spacing:0;font-size:0.72rem;">(optional)</span></label>
                        <input type="url" name="image" class="form-input @error('image') is-invalid @enderror"
                               value="{{ old('image', $product->image) }}">
                        @error('image')<div class="form-error">{{ $message }}</div>@enderror
                        @if($product->image)
                            <div style="margin-top:0.7rem;display:flex;align-items:center;gap:0.7rem;">
                                <img src="{{ $product->image }}" style="height:56px;border-radius:5px;object-fit:cover;" alt="{{ $product->title }}">
                                <span style="font-size:0.76rem;color:var(--gray);">Current image</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group" style="margin-bottom:2rem;">
                        <label class="form-label">Availability</label>
                        <input type="hidden" name="is_available" value="0">
                        <label class="toggle-row">
                            <input type="checkbox" name="is_available" value="1"
                                   {{ old('is_available', $product->is_available) ? 'checked' : '' }}
                                   style="width:17px;height:17px;accent-color:var(--red);cursor:pointer;">
                            <div>
                                <div style="font-weight:600;font-size:0.88rem;color:var(--navy);">Available for booking</div>
                                <div style="font-size:0.76rem;color:var(--gray);">Customers can see and book this tour</div>
                            </div>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Tour</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
