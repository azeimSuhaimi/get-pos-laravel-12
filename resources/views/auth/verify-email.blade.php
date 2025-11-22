@extends('layouts.auth')
 
@section('title', 'Login page')
 
@section('content')

@include('partials.popup')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="ex-page-content text-center">
                    <h1></h1>
                    <h3>Email Verification Required</h3><br>
                        <p class="error-description">
                            Thank you for registering! To complete your registration and gain full access to our website, 
                            you need to verify your email address.
                        </p>
                        <p class="error-description">
                            An email with a verification link has been sent to your email address. Please check your inbox 
                            (and your spam folder, just in case) and click on the verification link to activate your account.
                        </p>
                        <p class="error-description">
                            If you haven't received the email, you can request a new verification email by logging in and 
                            clicking on the "Resend Verification Email" link.
                        </p>

                    <a class="btn btn-info mb-5 waves-effect waves-light" href="#" onclick="goBack()">Back </a>
                    <a class="btn btn-info mb-5 waves-effect waves-light" href="{{route('dashboard')}}">Dashboard</a>
                    <button form="button"  class="btn btn-info mb-5 waves-effect waves-light" type="submit">Resend Varification</button>
                    <form id="button" action="{{route('verification.send')}}" method="post">
                        @csrf
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection