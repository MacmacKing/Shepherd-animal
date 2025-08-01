@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">👥 Manage Users</h2>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">← Back to Admin Dashboard</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                    <td>
                        @if(!$user->is_admin)
                            <form action="{{ route('admin.users.makeAdmin', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">Make Admin</button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.revokeAdmin', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-warning btn-sm">Revoke Admin</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>
@endsection
