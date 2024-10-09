@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit User</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User Details</h4><br>
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Name" value="{{ $user->name }}" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="Email" value="{{ $user->email }}" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="user_status" class="form-label">Account Status</label>
                                <select class="form-select" id="user_status" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option>active</option>
                                    <option>inactive</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid Status.
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="password" class="form-label">Change Password</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Password" required>
                                <div class="invalid-feedback">
                                    Please provide a valid Password.
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    placeholder="Confirm Password" required>
                                <div class="invalid-feedback">
                                    Please provide a valid Password.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" class="form-control select2-search-disable" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="officer" {{ old('role', $user->role) == 'officer' ? 'selected' : '' }}>Officer</option>
                                <option value="driver" {{ old('role', $user->role) == 'driver' ? 'selected' : '' }}>Driver</option>
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                   
                    <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Other</h4>
               <br>
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label for="full_day_salary" class="form-label">Full Day Salary</label>
                                <input type="number" class="form-control" id="full_day_salary"
                                    placeholder="Full Day Salary" value="" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label for="half_day_salary" class="form-label">Half Day Salary</label>
                                <input type="number" class="form-control" id="half_day_salary"
                                    placeholder="Half Day Salary" value="" required>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shift_start_time" class="form-label">Shift End Time</label>
                                <div class="row">
                                    <!-- Hour dropdown (12-hour format) -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_start_hour" required>
                                            <option selected disabled>Hour</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <!-- Minute dropdown -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_start_minute" required>
                                            <option selected disabled>Minute</option>
                                            @for ($i = 0; $i <= 59; $i++)
                                                <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <!-- AM/PM dropdown -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_start_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid shift start time.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shift_end_time" class="form-label">Shift End Time</label>
                                <div class="row">
                                    <!-- Hour dropdown (12-hour format) -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_end_time" required>
                                            <option selected disabled>Hour</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <!-- Minute dropdown -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_end_minute" required>
                                            <option selected disabled>Minute</option>
                                            @for ($i = 0; $i <= 59; $i++)
                                                <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    
                                    <!-- AM/PM dropdown -->
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_end_ampm" required>
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid shift start time.
                                </div>
                            </div>
                        </div>
                        
                        
                        
        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="joining_date" class="form-label">Joining Date</label>
                                    <input type="date" class="form-control" id="joining_date" required>
                                    <div class="invalid-tooltip">
                                        Please provide a valid joining date.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div>

                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->
</div>


@endsection