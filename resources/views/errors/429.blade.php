@extends('layouts.auth')
 
@section('title', 'Login page')
 
@section('content')

@include('partials.popup')

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="ex-page-content text-center">
                    <h1>429!</h1>
                    <h3> {{ $exception->getMessage() }}</h3><br>

                    <a class="btn btn-info mb-5 waves-effect waves-light" href="{{route('login')}}">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection