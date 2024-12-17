@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit Profile</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Profile</h4><br>
                <form action="{{ route('user.update', $user->id) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3 text-center">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <div class="position-relative">
                                    <img 
                                        id="profile-pic-preview" 
                                        src="{{ $user->profile_picture ? asset($user->profile_picture) : asset('/images/users/avatar-1.png') }}" 
                                        alt="Profile Picture Preview" 
                                        class="avatar-lg rounded-circle mb-3"
                                        style="cursor: pointer;"
                                    >
                                    <input 
                                        type="file" 
                                        id="profile_picture" 
                                        name="profile_picture" 
                                        class="form-control" 
                                        accept="image/*" 
                                        onchange="previewProfilePicture(this)" 
                                        style="display: none;"
                                    >
                                </div>
                                <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('profile_picture').click();">
                                    Upload Picture
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
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
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email (Read Only)</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $user->email) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Update Password</h4>
                <form action="{{ route('user.password', $user->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Re-enter Password">
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function previewProfilePicture(input) {
        const file = input.files[0];
        const preview = document.getElementById('profile-pic-preview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
