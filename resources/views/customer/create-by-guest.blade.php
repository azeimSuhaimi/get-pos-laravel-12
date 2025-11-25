@extends('layouts.auth')
 
@section('title', 'Login page')
 
@section('content')

@include('partials.popup')



<div class="card mb-3">

    <div class="card-body text-bg-light">

        <div class="pt-4 pb-2">
            <a href="{{route('login')}}" class="btn btn-primary mb-4">BACK</a>
            <h5 class="card-title text-center pb-0 fs-4">Register Your Customer</h5>
            <p class="text-center small">Register Member Here</p>
        </div>


        <form class="submit" onsubmit="confirmAndSubmit(this)" action="{{route('customer.store.by.guest')}}" method="post">
            @csrf

            <div class="form-floating mb-3 mb-md-4">
                <input class="form-control @error('name') is-invalid @enderror" name="name" id="Name" type="text" value="{{ old('name') }}" />
                <label for="name">Name <span class="text-danger">*</span></label>
                @error('name')
                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3 mb-md-4">

                <input class="form-control @error('address') is-invalid @enderror" name="address" id="address" type="text" value="{{ old('address') }}" />
                <label for="name">Address</label>
                @error('address')
                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                @enderror
            </div>


            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0 ">
                        <input class="form-control @error('email') is-invalid @enderror" name="email" id="email" type="text" value="{{ old('email') }}" />
                        <label for="email">Email <span class="text-danger">*</span></label>
                        @error('email')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" type="tel" value="{{ old('phone') }}" />
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        @error('phone')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <span class="badge rounded-pill text-bg-info">Use Phone Have WhatsApp</span>
                </div>
            </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
        </form>

    </div>
</div>



@endsection