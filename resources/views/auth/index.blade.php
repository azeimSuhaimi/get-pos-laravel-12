@extends('layouts.auth')
 
@section('title', 'Login page')
 
@section('content')

@include('partials.popup')

        <div class="card" data-aos="fade-right">
            <div class="card-body">

                <div class="text-center mt-4">
                    <div class="mb-3">
                        <a href="{{route('auth')}}" class="auth-logo">
                            <img src="{{asset('assets/images/logo-dark.png')}}" height="30" class="logo-dark mx-auto" alt="">
                            <img src="{{asset('assets/images/logo-light.png')}}" height="30" class="logo-light mx-auto" alt="">
                        </a>
                    </div>
                </div>

                <h4 class="text-muted text-center font-size-18"><b>Sign In</b></h4>

                <div class="p-3">
                    <form class="form-horizontal mt-3" method="POST" action="{{route('auth.login')}}">
                        @csrf
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" type="text"  placeholder="Email">
                                @error('email')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" type="password"  placeholder="Password">
                                @error('password')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="show_password" onchange="showPassword()">
                                    <label class="form-label ms-1" for="show_password">Show Password</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember_token"  id="rememberMe">
                                    <label class="form-label ms-1" for="rememberMe">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                    </form>

                    <hr>
                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <a class="btn btn-info w-100 waves-effect waves-light" href="{{route('github-varify')}}">Login With GITHUB</a>
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <a class="btn btn-info w-100 waves-effect waves-light" href="{{route('google-varify')}}">Login With GOOGLE</a>
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <a class="btn btn-info w-100 waves-effect waves-light" href="{{route('linkedin-varify')}}">Login With LingkedIn</a>
                            </div>
                        </div>

                        <div class="form-group mb-0 row mt-2">
                            <div class="col-sm-7 mt-3">
                                <a href="{{route('auth.forgot.password')}}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                            </div>
                            <div class="col-sm-5 mt-3">
                                <!--  <a href="auth-register.html" class="text-muted"><i class="mdi mdi-account-circle"></i> Create an account</a>-->
                            </div>
                        </div>
                </div>
                <!-- end -->
            </div>
            <!-- end cardbody -->
        </div>
        <!-- end card -->

<script>
    function showPassword() 
    {
    // Get the password input and checkbox elements
    var password = document.getElementById("password");
    var checkbox = document.getElementById("show_password");

    // Check the state of the checkbox
    if (checkbox.checked) {
        // If the checkbox is checked, change the input type to "text"
        password.type = "text";
    } else {
        // If the checkbox is not checked, change the input type back to "password"
        password.type = "password";
    }
    }

</script>

@endsection