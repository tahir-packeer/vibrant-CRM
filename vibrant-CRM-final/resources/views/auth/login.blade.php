@extends('layouts.app')

@section('content')
    <div class="login-wrapper d-flex">
        <!-- Right Side with Image -->
        <div class="login-image"></div>

        <!-- Left Side with Login Form -->
        <div class="login-form d-flex justify-content-center align-items-center">
            <div class="card p-4 shadow-sm">
                <h3 class="text-center mb-4 text-bold" id="form-title">Log In</h3>

                <!-- Login Tabs -->
                <ul class="nav nav-tabs justify-content-center mb-3" id="login-signup-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link active" id="login-tab" onclick="showLogin()" type="button" role="tab">Log In</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#" class="nav-link" style="color: gray" id="signup-tab" onclick="showRegister()" type="button" role="tab">Register</a>
                    </li>
                </ul>

                <!-- Login Form -->
                <div id="login-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email" class="form-label text">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label text">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Log In
                            </button>
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="form-group d-flex justify-content-between">
                            @if (Route::has('password.request'))
                                <a class="text-center" style="color: gray" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Registration Form -->
                <div id="register-form" style="display: none;">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email-register" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password-register" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password-confirm" class="form-label">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group mb-3">
                            <label for="user_type" class="form-label">User Type</label>
                            <select id="user_type" class="form-control @error('user_type') is-invalid @enderror" name="user_type" required>
                                <option value="customer">Customer</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('user_type')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS for Login Page -->
    <style>
        .login-wrapper {
            display: flex;
            height: 100vh; /* Full viewport height */
        }

        .login-image {
            flex: 1; /* Take 50% of the width */
            background: url('{{ asset('images/gym.jpg') }}') no-repeat center center;
            background-size: cover;
            min-height: 100vh; /* Full-height on large screens */
        }

        .login-form {
            flex: 1; /* Take 50% of the width */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: white;
        }

        .login-form .card {
            width: 100%;
            max-width: 400px; /* Adjust the width of the form */
            padding: 30px;
            background-color: #ffffff; /* Card background */
            color: #000000; /* Text color */
        }

        .form-control {
            background-color: #ffffff; /* White background for inputs */
            color: #000000; /* Black text in inputs */

        }

        .form-control:focus {
            background-color: #ffffff; /* Keep white on focus */
            border-color: #636363; /* Focus border color */
            box-shadow: none; /* Remove focus shadow */
        }

        .btn-primary {
            background-color: #000000; /* Button background color */
            border: none;
        }

        .btn-primary:hover {
            background-color: #000000; /* Button hover color */
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column; /* Stack vertically on smaller screens */
            }

            .login-image {
                display: none; /* Hide image on smaller screens */
            }

            .login-form {
                width: 100%;
            }
        }
    </style>

    <!-- JavaScript to Handle Form Switching -->
    <script>
        function showLogin() {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('register-form').style.display = 'none';
            document.getElementById('form-title').innerText = 'Log In';
            document.getElementById('login-tab').classList.add('active');
            document.getElementById('signup-tab').classList.remove('active');
        }

        function showRegister() {
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('register-form').style.display = 'block';
            document.getElementById('form-title').innerText = 'Register';
            document.getElementById('login-tab').classList.remove('active');
            document.getElementById('signup-tab').classList.add('active');
        }
    </script>
@endsection
