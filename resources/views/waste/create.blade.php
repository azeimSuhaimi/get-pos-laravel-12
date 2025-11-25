@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Waste</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('waste')}}">Waste</a></li>
                    <li class="breadcrumb-item active">Create</li>
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
                
                <div class="pt-4 pb-2">
                    <a href="{{route('waste')}}" class="btn btn-primary mb-4">BACK</a>
                    <h5 class="card-title text-center pb-0 fs-4"> CREATE NEW WASTE</h5>
                    <p class="text-center small">Enter details waste Here</p>
                </div>

                <!-- Multi Columns Form -->
                <form class="row g-3" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('waste.create.store')}}">

                    @csrf
                    <div class="col-md-12">
                    <label for="shortcode" class="form-label">Shortcode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('shortcode') is-invalid @enderror" value="{{  old('shortcode') }}" name="shortcode" id="shortcode">
                    @error('shortcode')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                    </div>
  
                    <div class="col-md-6">
                        <label for="quantity" class="form-label">Waste Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{  old('quantity') }}" name="quantity" id="quantity">
                        @error('quantity')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>
            

                    <div class="col-md-12">
                        <label for="reason" class="form-label">Waste Reason <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reason') is-invalid @enderror" value="{{  old('reason') }}" name="reason" id="reason">
                        @error('reason')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="col-md-12">
                        <label for="remark" class="form-label">Waste Remark <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('remark') is-invalid @enderror" value="{{  old('remark') }}" name="remark" id="remark">
                        @error('remark')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form><!-- End Multi Columns Form -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection