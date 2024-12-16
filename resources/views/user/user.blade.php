@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">User Login Logs</h4>

                <div class="table-responsive">
                    <table class="table table-nowrap align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->role !== 'superadmin')
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if ($user->isOnline())
                                                <span style="color: green;">Online</span>
                                            @else
                                                <span style="color: red;">Offline</span>
                                                @if ($user->last_seen)
                                                    <br>
                                                    <small>Last seen: {{ \Carbon\Carbon::parse($user->last_seen)->setTimezone('Asia/Kolkata')->format('Y-m-d h:i A') }} Indian Standard Time</small>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td style="width: 100px">
                                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
