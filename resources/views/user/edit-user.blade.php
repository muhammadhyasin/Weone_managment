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
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $user->name) }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                                <div class="valid-feedback">Looks good!</div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_status" class="form-label">Account Status</label>
                                <select class="form-select" id="user_status" name="user_status" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="active" {{ old('account_status', $user->account_status) == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('account_status', $user->account_status) == '0' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                <div class="invalid-feedback">Please select a valid Status.</div>
                                @error('user_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select id="role" class="form-control select2-search-disable" name="role" required>
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="officer" {{ old('role', $user->role) == 'officer' ? 'selected' : '' }}>Officer</option>
                                    <option value="driver" {{ old('role', $user->role) == 'driver' ? 'selected' : '' }}>Driver</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <form action="{{ route('user.password', $user->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <h4 class="card-title">Password</h4>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Change Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <div class="invalid-feedback">Please provide a valid Password.</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm Password">
                            <div class="invalid-feedback">Passwords must match.</div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Other</h4>
                <br>
                <form action="{{ route('user.salary.storeOrUpdate', $user->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <!-- Full Day Salary -->
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label for="full_day_salary" class="form-label">Full Day Salary</label>
                                <input type="number" class="form-control" id="full_day_salary" name="full_day_salary"
                                    placeholder="Full Day Salary" value="{{ old('full_day_salary', $userSalary->full_day_salary ?? '') }}" required>
                                <div class="valid-tooltip">Looks good!</div>
                                @error('full_day_salary')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Half Day Salary -->
                        <div class="col-md-4">
                            <div class="mb-3 position-relative">
                                <label for="half_day_salary" class="form-label">Half Day Salary</label>
                                <input type="number" class="form-control" id="half_day_salary" name="half_day_salary"
                                    placeholder="Half Day Salary" value="{{ old('half_day_salary', $userSalary->half_day_salary ?? '') }}" required>
                                <div class="valid-tooltip">Looks good!</div>
                                @error('half_day_salary')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Shift Start Time -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shift_start_time" class="form-label">Shift Start Time</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_start_hour" name="shift_start_hour" required>
                                            <option selected disabled>Hour</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('shift_start_hour', $userSalary->shift_start_hour ?? '') == $i ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_start_minute" name="shift_start_minute" required>
                                            <option selected disabled>Minute</option>
                                            @for ($i = 0; $i <= 59; $i++)
                                                <option value="{{ $i }}" {{ old('shift_start_minute', $userSalary->shift_start_minute ?? '') == $i ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_start_ampm" name="shift_start_ampm" required>
                                            <option value="AM" {{ old('shift_start_ampm', $userSalary->shift_start_ampm ?? '') == 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM" {{ old('shift_start_ampm', $userSalary->shift_start_ampm ?? '') == 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                @error('shift_start_time')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Shift End Time -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="shift_end_time" class="form-label">Shift End Time</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_end_hour" name="shift_end_hour" required>
                                            <option selected disabled>Hour</option>
                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ old('shift_end_hour', $userSalary->shift_end_hour ?? '') == $i ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_end_minute" name="shift_end_minute" required>
                                            <option selected disabled>Minute</option>
                                            @for ($i = 0; $i <= 59; $i++)
                                                <option value="{{ $i }}" {{ old('shift_end_minute', $userSalary->shift_end_minute ?? '') == $i ? 'selected' : '' }}>
                                                    {{ sprintf('%02d', $i) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control" id="shift_end_ampm" name="shift_end_ampm" required>
                                            <option value="AM" {{ old('shift_end_ampm', $userSalary->shift_end_ampm ?? '') == 'AM' ? 'selected' : '' }}>AM</option>
                                            <option value="PM" {{ old('shift_end_ampm', $userSalary->shift_end_ampm ?? '') == 'PM' ? 'selected' : '' }}>PM</option>
                                        </select>
                                    </div>
                                </div>
                                @error('shift_end_time')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Joining Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="joining_date" class="form-label">Joining Date</label>
                                <input type="date" class="form-control" id="joining_date" name="joining_date"
                                    value="{{ old('joining_date', optional($userSalary->joining_date)->toDateString()) }}" required>
                                @error('joining_date')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection