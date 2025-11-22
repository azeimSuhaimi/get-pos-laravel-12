@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Change Password</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <!-- Change Password Form -->
                <form method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('user.change.password.update')}}">

                    @csrf

                    <div class="row mb-3">
                        <label for="password1" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" placeholder="empty this if you register with google etc">
                        @error('password')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password1" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="password1" onkeydown="checkPasswordStrength()" type="password" class="form-control @error('password1') is-invalid @enderror" value="{{ old('password1') }}" id="password1">
                        <span class="  mt-2" id="password-strength"></span>
                        @error('password1')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password2" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="password2" type="password" class="form-control @error('password2') is-invalid @enderror" value="{{ old('password2') }}" id="password2">
                        @error('password2')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" id="show_password" onchange="showPassword()" />
                            <label class="form-check-label" for="show_password">Show Password</label>
                        </div>
                    </div>

                    <!-- 
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>-->

                    <div class="form-group mb-3 text-center row mt-3 pt-1">
                        <div class="col-12">
                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Change Password</button>
                        </div>
                    </div>
                </form><!-- End Change Password Form -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script>
    function showPassword() {
    // Get the password input and checkbox elements
    var password = document.getElementById("password");
    var password1 = document.getElementById("password1");
    var password2 = document.getElementById("password2");
    var checkbox = document.getElementById("show_password");

    // Check the state of the checkbox
    if (checkbox.checked) {
        // If the checkbox is checked, change the input type to "text"
        password.type = "text";
        password1.type = "text";
        password2.type = "text";
    } else {
        // If the checkbox is not checked, change the input type back to "password"
        password.type = "password";
        password1.type = "password";
        password2.type = "password";
    }
    }

</script>

<script>
    function checkPasswordStrength() {
        var password = document.getElementById("password1").value;
        var strength = 0;
    
        // Check for length
        if (password.length < 6) {
            document.getElementById("password-strength").innerHTML = "Too short";
            return;
        }
    
        // Check for uppercase
        if (password.match(/[A-Z]/)) {
            strength++;
        }
    
        // Check for lowercase
        if (password.match(/[a-z]/)) {
            strength++;
        }
    
        // Check for numbers
        if (password.match(/\d+/)) {
            strength++;
        }
    
        // Check for special characters
        if (password.match(/[!@#$%^&*]/)) {
            strength++;
        }
    
        // Display strength
        switch (strength) {
            case 0:
                document.getElementById("password-strength").innerHTML = "Too Weak";
                break;
            case 1:
                document.getElementById("password-strength").innerHTML = "Weak";
                break;
            case 2:
                document.getElementById("password-strength").innerHTML = "Moderate";
                break;
            case 3:
                document.getElementById("password-strength").innerHTML = "Strong";
                break;
            case 4:
                document.getElementById("password-strength").innerHTML = "Very Strong";
                break;
        }
    }
</script>


@endsection