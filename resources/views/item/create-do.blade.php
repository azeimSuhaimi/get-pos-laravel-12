@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Items</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('item')}}">Items</a></li>
                    <li class="breadcrumb-item active">Create Do</li>
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
                <!-- Multi Columns Form -->
                <a href="{{route('item')}}" class="btn btn-primary ">BACK</a>

                <form id="priceForm" class="row g-3" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('do.create.store')}}">
        
                @csrf
                <div class="col-md-12">
                    <label for="grn_no" class="form-label">GRN No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('grn_no') is-invalid @enderror" value="{{  old('grn_no') }}" name="grn_no" id="grn_no">
                    @error('grn_no')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="date_receive" class="form-label">Date Receive <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('date_receive') is-invalid @enderror" value="{{  old('date_receive') }}" name="date_receive" id="date_receive">
                    @error('date_receive')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="receive_by" class="form-label">Receive By<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('receive_by') is-invalid @enderror" value="{{  old('receive_by') }}" name="receive_by" id="receive_by">
                    @error('receive_by')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="supplier" class="form-label">Supplier <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('supplier') is-invalid @enderror" value="{{  old('supplier') }}" name="supplier" id="supplier">
                    @error('supplier')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="do_number" class="form-label">D.O Number<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('do_number') is-invalid @enderror" value="{{  old('do_number') }}" name="do_number" id="do_number">
                    @error('do_number')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
        
                <div class="col-md-12">
                    <label for="remark" class="form-label">Remark <span class="text-danger">*</span></label>
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