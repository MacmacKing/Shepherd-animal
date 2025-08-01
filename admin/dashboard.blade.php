@extends('layouts.app')

@section('content')

<div class="d-flex gap-2 mb-3">
    <a href="{{ route('admin.users') }}" class="btn btn-dark">👥 Manage Users</a>
    <a href="{{ route('services.index') }}" class="btn btn-outline-primary">🛠️ Manage Services</a>
    <a href="{{ route('admin.pets.index') }}" class="btn btn-outline-success">🐶 Pet Records</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">🧾 View Orders</a>
    <a href="{{ url('/') }}" class="btn btn-outline-primary">🏠 Home</a>
</div>


<div class="container mt-5">
    <h2 class="mb-4">👨‍⚕️ Admin Dashboard — All Appointments</h2>
    @if(session('success'))
        <div id="successAlert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
     <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by User or Pet" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">🔍 Search</button>
            </div>
        </form>

    @if($bookings->count())
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>User</th>
                    <th>Pet Name</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Notes</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)

                    <tr>
                        <td>{{ $booking->user->name ?? '—' }}</td>
                        <td>{{ $booking->pet_name }}</td>
                        <td>{{ $booking->service_type }}</td>
                        <td>{{ $booking->preferred_date }}</td>
                        <td>{{ $booking->preferred_time }}</td>
                        <td>{{ $booking->notes ?? '—' }}</td>
                        <td>
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
                        </td>
                        <td>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Cancel this appointment?')">Cancel</button>
                            </form>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $bookings->links() }}
        </div>
    @else
        <p>No bookings found.</p>
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alert = document.getElementById("successAlert");
        if (alert) {
            setTimeout(() => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = 0;
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        }
    });
</script>
@endsection
