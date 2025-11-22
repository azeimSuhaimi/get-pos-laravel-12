@extends('layouts.auth')
 
@section('title', 'Login page')
 
@section('content')

@include('partials.popup')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="ex-page-content text-center">
                    <h1>404!</h1>
                    <h3>Sorry, page not found</h3><br>

                    <a class="btn btn-info mb-5 waves-effect waves-light" href="{{route('dashboard')}}">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection