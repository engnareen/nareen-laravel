<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset('assets/login/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/main.css') }}">
<!--===============================================================================================-->

<!-- Styles -->

<style>
    .font-medium{
        font-weight: 500;
    }
    .text-red-600{
        --tw-text-opacity:1;color:rgb(220 38 38/var(--tw-text-opacity))
    }
    .text-green-600{--tw-text-opacity:1;color:rgb(22 163 74/var(--tw-text-opacity))}
    .text-sm{font-size:.875rem;line-height:1.25rem}
    a{
        line-height: 2.7;
        padding: 0 5px;
        font-size: 16px;
    }
    a:hover{
        color: #d41872;
    }
</style>
</head>
<body>



            <!-- -->
            <div class="limiter">
                <div class="container-login100">
                    <div class="wrap-login100">
                        <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                            @csrf
                            <span class="login100-form-title p-b-26">
                                Welcome
                            </span>
                            <span class="login100-form-title p-b-48">
                                <i class="zmdi zmdi-font"></i>
                            </span>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <!-- Email -->
                            <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                                <x-input id="email" class="input100" type="email" name="email" :value="old('email')" required autofocus />
                                <span class="focus-input100" data-placeholder="Email"></span>
                            </div>


                            <!-- Password -->
                            <div class="wrap-input100 validate-input" data-validate="Enter password">
                                <span class="btn-show-pass">
                                    <i class="zmdi zmdi-eye"></i>
                                </span>
                                <x-input id="password" class="input100" type="password" name="password"  required autocomplete="current-password" />
                                <span class="focus-input100" data-placeholder="Password"></span>
                            </div>

                            <div class="container-login100-form-btn">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <x-button class="login100-form-btn">
                                        {{ __('Log in') }}
                                    </x-button>
                                </div>
                            </div>

                            <div class="text-center p-t-115">
                                @if (Route::has('password.request'))
                                    <a class="txt1" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div id="dropDownSelect1"></div>

            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/vendor/animsition/js/animsition.min.js') }}"></script>
            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/vendor/bootstrap/js/popper.js') }}"></script>
                <script src="{{ asset('assets/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/vendor/select2/select2.min.js') }}"></script>
            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/vendor/daterangepicker/moment.min.js') }}"></script>
                <script src="{{ asset('assets/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/vendor/countdowntime/countdowntime.js') }}"></script>
            <!--===============================================================================================-->
                <script src="{{ asset('assets/login/js/main.js') }}"></script>

            </body>
            </html>
   <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}
