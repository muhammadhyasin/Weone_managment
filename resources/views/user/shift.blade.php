@extends('layouts.main')
@section('content')
<div class="row">
    <!-- Shift Entry Form -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Shift</h4>
                <form method="POST" action="{{ route('shifts.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="shift_name" class="form-label">Shift Name</label>
                        <input type="text" class="form-control" id="shift_name" name="name" placeholder="Shift Name (e.g., 1st Shift)" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                        @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">End Time</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                        @error('end_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Add Shift</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Shifts List -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Shifts List</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Shift Name</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shifts as $shift)
                            <tr>
                                <td>{{ $shift->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('h:i A') }}</td>
                                <td>{{ \Carbon\Carbon::parse($shift->end_time)->format('h:i A') }}</td>
                                <td class="text-center">
                                    <!-- Edit Button to trigger Modal -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editShiftModal-{{ $shift->id }}">
                                        Edit
                                    </button>

                                    <!-- Modal for Editing Shift -->
                                    <div class="modal fade" id="editShiftModal-{{ $shift->id }}" tabindex="-1" role="dialog" aria-labelledby="editShiftModalLabel-{{ $shift->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editShiftModalLabel-{{ $shift->id }}">Edit Shift</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('shifts.update', $shift->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="mb-3">
                                                            <label for="shift_name_{{ $shift->id }}" class="form-label">Shift Name</label>
                                                            <input type="text" class="form-control" id="shift_name_{{ $shift->id }}" name="name" value="{{ $shift->name }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="start_time_{{ $shift->id }}" class="form-label">Start Time</label>
                                                            <input type="time" class="form-control" id="start_time_{{ $shift->id }}" name="start_time" value="{{ $shift->start_time }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="end_time_{{ $shift->id }}" class="form-label">End Time</label>
                                                            <input type="time" class="form-control" id="end_time_{{ $shift->id }}" name="end_time" value="{{ $shift->end_time }}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Shift -->
                                    <form action="{{ route('shifts.destroy', $shift->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this shift?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
