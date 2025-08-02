@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Appointment</h2>

    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pet Name</label>
            <input type="text" name="pet_name" value="{{ $booking->pet_name }}" required class="form-control">
        </div>

        <div class="mb-3">
            <label>Service</label>
            <select name="service_type" class="form-control" required>
                @foreach(['Grooming', 'Consultation', 'Surgery', 'Laboratory', 'Vaccination'] as $service)
                    <option value="{{ $service }}" {{ $booking->service_type === $service ? 'selected' : '' }}>{{ $service }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Preferred Date</label>
            <input type="date" name="preferred_date" value="{{ $booking->preferred_date }}" required class="form-control">
        </div>

        <div class="mb-3">
            <label>Preferred Time</label>
            <input type="time" name="preferred_time" value="{{ $booking->preferred_time }}" required class="form-control">
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ $booking->notes }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Appointment</button>
    </form>
</div>
@endsection
