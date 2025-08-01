@extends('layouts.app') 
@section('content')
<div class="container">
    <h1 class="mb-4">🧾 All Orders</h1>

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2">
            <input type="text" name="search_user" class="form-control form-control-sm" placeholder="Search by User" value="{{ request('search_user') }}" style="width: 160px;">
            <input type="text" name="search_product" class="form-control form-control-sm" placeholder="Search by Product" value="{{ request('search_product') }}" style="width: 160px;">
            <button type="submit" class="btn btn-sm btn-primary">🔍 Search</button>
        </form>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-secondary ms-auto mt-2 mt-md-0">⬅️ Back to Dashboard</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Product</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date Ordered</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr>
                <td>{{ $order->user->name ?? 'N/A' }}</td>
                <td>{{ $order->product->name ?? 'N/A' }}</td>
                <td>₱{{ number_format($order->amount, 2) }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No orders found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
