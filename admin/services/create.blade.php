@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">➕ Add New Service</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (₱)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01">
        </div>

        <button type="submit" class="btn btn-success">💾 Save Service</button>
        <a href="{{ route('services.index') }}" class="btn btn-secondary">⬅ Back</a>
    </form>
</div>
@endsection
