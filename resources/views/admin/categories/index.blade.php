@extends('layouts.app')
@section('title', 'Manage Cities — Admin')

@section('content')

<div class="page-header">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1rem;">
            <div>
                <div class="section-label" style="color:var(--gold);">Admin Panel</div>
                <h1 class="section-title" style="color:white;">Manage Cities</h1>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Add New City</a>
        </div>
    </div>
</div>

<div class="container" style="padding-top:2.5rem;padding-bottom:3rem;">

    <div style="margin-bottom:1rem;">
        <a href="{{ route('admin.home') }}" style="font-size:0.83rem;color:var(--gray);font-weight:500;">&larr; Dashboard</a>
    </div>

    @if($categories->isEmpty())
        <div class="admin-card" style="padding:3rem;text-align:center;">
            <p style="color:var(--gray);font-size:0.9rem;">No cities yet. <a href="{{ route('admin.categories.create') }}" style="color:var(--red);font-weight:600;">Add the first one!</a></p>
        </div>
    @else
        <div class="admin-card">
            <div class="table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>Description</th>
                            <th>Tours</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:0.8rem;">
                                    @if($category->image)
                                        <img src="{{ $category->image }}" class="thumb" alt="{{ $category->name }}">
                                    @else
                                        <div class="thumb-ph">&#127963;</div>
                                    @endif
                                    <span style="font-weight:600;color:var(--navy);">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td style="color:var(--gray);max-width:300px;font-size:0.84rem;">{{ Str::limit($category->description, 70) }}</td>
                            <td>
                                <span style="background:rgba(99,102,241,0.08);color:#6366f1;font-size:0.72rem;font-weight:600;padding:0.2rem 0.65rem;border-radius:50px;">
                                    {{ $category->products_count }} tour(s)
                                </span>
                            </td>
                            <td>
                                <div style="display:flex;gap:0.4rem;">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit-sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" style="display:inline;" onsubmit="return confirm('Delete {{ $category->name }}? This also deletes its tours!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-del-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
