@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">✏️ Edit Pet Record</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Please fix the following issues:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pets.update', $pet->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Pet Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $pet->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="breed" class="form-label">Breed</label>
            <input type="text" name="breed" class="form-control" value="{{ old('breed', $pet->breed) }}">
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" name="age" class="form-control" value="{{ old('age', $pet->age) }}">
        </div>

        <button type="submit" class="btn btn-primary">💾 Update Pet</button>
        <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">⬅ Cancel</a>
    </form>
</div>
@endsection
