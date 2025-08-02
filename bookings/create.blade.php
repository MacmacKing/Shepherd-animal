@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">📅 Book a New Appointment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        

        <div class="mb-3">
            <label for="service_type" class="form-label">Service</label>
            <select class="form-control" id="service_type" name="service_type" required>
                <option value="">Select a service</option>
                <option value="Grooming">Grooming</option>
                <option value="Consultation">Consultation</option>
                <option value="Surgery">Surgery</option>
                <option value="Laboratory">Laboratory</option>
                <option value="Vaccination">Vaccination</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pet_name" class="form-label">Pet Name</label>
            <input type="text" class="form-control" id="pet_name" name="pet_name" required>
        </div>

        <div class="mb-3">
            <label for="preferred_date" class="form-label">Preferred Date</label>
            <input type="date" class="form-control" id="preferred_date" name="preferred_date" required>
        </div>

        <div class="mb-3">
            <label for="preferred_time" class="form-label">Preferred Time</label>
            <input type="time" class="form-control" id="preferred_time" name="preferred_time" required>
        </div>

        <div class="mb-3">
            <label for="pet_name" class="form-label">Contact No</label>
            <input type="text" class="form-control" id="contact" name="contact" required>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes (Optional)</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">📩 Submit Booking</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">⬅ Back</a>
    </form>
</div>
@endsection
