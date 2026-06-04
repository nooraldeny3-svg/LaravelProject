@extends('layouts.app')
@section('title', 'Edit City — Admin')

@section('styles')
<style>
    .form-wrap { max-width: 620px; margin: 0 auto; padding: 2.5rem 0 3rem; }
    .form-actions { display: flex; gap: 0.8rem; margin-top: 2rem; }
    .errors-box { background: #fee2e2; border-left: 4px solid var(--red); border-radius: 6px; padding: 0.9rem 1.1rem; margin-bottom: 1.4rem; }
    .errors-box ul { padding-left: 1.2rem; font-size: 0.83rem; color: #b91c1c; }
</style>
@endsection

@section('content')

<div class="page-header">
    <div class="container">
        <div class="section-label" style="color:var(--gold);">Admin Panel</div>
        <h1 class="section-title" style="color:white;">Edit: {{ $category->name }}</h1>
    </div>
</div>

<div class="container">
    <div class="form-wrap">
        <div style="margin-bottom:1rem;">
            <a href="{{ route('admin.categories.index') }}" style="font-size:0.83rem;color:var(--gray);font-weight:500;">&larr; All Cities</a>
        </div>

        <div class="form-card">
            <div class="form-card-header">Edit City Information</div>
            <div class="form-card-body">

                @if($errors->any())
                    <div class="errors-box">
                        <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">City Name <span style="color:var(--red);">*</span></label>
                        <input type="text" name="name" class="form-input @error('name') is-invalid @enderror"
                               value="{{ old('name', $category->name) }}" required>
                        @error('name')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-input @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                        @error('description')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group" style="margin-bottom:2rem;">
                        <label class="form-label">Image URL <span style="color:var(--gray);text-transform:none;letter-spacing:0;font-size:0.72rem;">(optional)</span></label>
                        <input type="url" name="image" class="form-input @error('image') is-invalid @enderror"
                               value="{{ old('image', $category->image) }}">
                        @error('image')<div class="form-error">{{ $message }}</div>@enderror
                        @if($category->image)
                            <div style="margin-top:0.7rem;display:flex;align-items:center;gap:0.7rem;">
                                <img src="{{ $category->image }}" style="height:56px;border-radius:5px;object-fit:cover;" alt="{{ $category->name }}">
                                <span style="font-size:0.76rem;color:var(--gray);">Current image</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update City</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
