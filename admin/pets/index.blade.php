@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">🐶 Admin Panel — Pet Records</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">⬅ Back to Dashboard</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.pets.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search pets or owners..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark btn-sm w-100">🔍 Search</button>
        </div>
    </form>

    @if($pets->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Pet Name</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Owner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->breed }}</td>
                    <td>{{ $pet->age }}</td>
                    <td>{{ $pet->user->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.pets.edit', $pet->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('admin.pets.destroy', $pet->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this pet?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $pets->links() }}
        </div>
    @else
        <p>No pets found.</p>
    @endif
</div>
@endsection
