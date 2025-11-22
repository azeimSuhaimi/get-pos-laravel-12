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

                <h4 class="text-muted text-center font-size-18"><b>Reset Your Password?</b></h4>

                <div class="p-3">
                    <form onsubmit="confirmAndSubmit(this)" class="form-horizontal mt-3" method="POST" action="{{route('password.update')}}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" type="password"  placeholder="Please enter your New password!">
                                @error('password')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}" type="password"  placeholder="Please enter your Comfirm password !">
                                @error('password_confirmation')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>

                    </form>

                    <hr>

                        <div class="form-group mb-0 row mt-2">
                            <div class="col-sm-7 mt-3">
                                <a href="{{route('auth')}}" class="text-muted"><i class="mdi mdi-lock"></i> Login</a>
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

@endsection