@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if(auth()->check() && auth()->user()->is_admin)
        <h2 class="mb-4">✅ Booking updated</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dark mb-4">🔧 Back to Admin Dashboard</a>
    @else
        <h2 class="mb-4">📅 My Appointments</h2>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('bookings.create') }}" class="btn btn-success">➕ Book New Appointment</a>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">🏠 Home</a>
        </div>
    @endif

    @if($bookings->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Pet Name</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Contact</th>
                    <th>Notes</th>
                    <th>Booked At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->pet_name }}</td>
                        <td>{{ $booking->service_type }}</td>
                        <td>{{ $booking->preferred_date }}</td>
                        <td>{{ $booking->preferred_time }}</td>
                        <td>{{ $booking->contact }}</td>
                        <td>{{ $booking->notes ?? '—' }}</td>
                        <td>{{ $booking->created_at->format('M d, Y h:i A') }}</td>

                        <td>
                            @if(auth()->user()->is_admin)
                                <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>🟡 Pending</option>
                                        <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>🔵 Confirmed</option>
                                        <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>🟢 Completed</option>
                                        <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>🔴 Cancelled</option>
                                    </select>
                                </form>
                            @else
                                <span class="badge 
                                    @if($booking->status === 'Pending') bg-warning
                                    @elseif($booking->status === 'Confirmed') bg-primary
                                    @elseif($booking->status === 'Completed') bg-success
                                    @elseif($booking->status === 'Cancelled') bg-danger
                                    @endif
                                ">
                                    {{ $booking->status }}
                                </span>
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Cancel</button>
                            </form>

                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach

                <div class="mt-4 d-flex justify-content-center">
                        {{ $bookings->links() }}
                    </div>

            </tbody>
        </table>

    @else
        <p>You don't have any appointments yet.</p>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById("successAlert");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = 0;
                setTimeout(() => alert.remove(), 500); // Remove after fade
            }, 3000); // 3 seconds
        }
    });
</script>
@endsection
