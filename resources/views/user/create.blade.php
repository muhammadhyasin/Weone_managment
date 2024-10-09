<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | Upcube - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.add') }}">
                        @csrf
                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="index.html" class="auth-logo">
                                    <img src="assets/images/logo-dark.png" height="30" class="logo-dark mx-auto" alt="">
                                    <img src="assets/images/logo-light.png" height="30" class="logo-light mx-auto" alt="">
                                </a>
                            </div>
                        </div>

                        <h4 class="text-muted text-center font-size-18"><b>Register New User</b></h4>

                        <div class="p-3">

                            <!-- Email Field -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input for="email" id="emails" class="form-control @error('email') is-invalid @enderror" 
                                           type="email" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           placeholder="Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Username Field -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input id="name" for="name" class="form-control @error('name') is-invalid @enderror" 
                                           type="text" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required 
                                           placeholder="Name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control @error('password') is-invalid @enderror" 
                                           type="password" 
                                           id="password"
                                           for="password"
                                           name="password" 
                                           required 
                                           placeholder="Password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password Field -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <input class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           type="password" 
                                           id="password_confirmation"
                                           for="password_confirmation"
                                           name="password_confirmation" 
                                           required 
                                           placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role Selection Dropdown -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" 
                                            name="role" required>
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="officer" {{ old('role') == 'officer' ? 'selected' : '' }}>Officer</option>
                                        <option value="driver" {{ old('role') == 'driver' ? 'selected' : '' }}>Driver</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end form -->
                </div>
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->
    </div>
    <!-- end container -->
</div>
<!-- end -->

<!-- JAVASCRIPT -->
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>
