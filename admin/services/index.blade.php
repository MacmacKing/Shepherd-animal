@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">🛠️ Manage Services</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">➕ Add New Service</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">⬅ Back to Dashboard</a>

    @if($services->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Price (₱)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->description ?? '—' }}</td>
                    <td>{{ $service->price ?? '—' }}</td>
                    <td>
                        <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                        <form action="{{ route('services.destroy', $service->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $services->links() }}
        </div>
    @else
        <p>No services found.</p>
    @endif
</div>
@endsection
