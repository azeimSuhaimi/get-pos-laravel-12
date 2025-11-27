@extends('layouts.main')
 
@section('title', 'create item redeem page')
 
@section('content')

@include('partials.popup')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Items</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('item.redeem')}}">Item Redeem</a></li>
                    <li class="breadcrumb-item active">Create Items Redeem</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
  



  <div class="card">
      <div class="card-body text-bg-light">
        


                <div class="pt-4 pb-2">
                    <a href="{{route('item.redeem')}}" class="btn btn-primary mb-4">BACK</a>
                    <h5 class="card-title text-center pb-0 fs-4">CREATE NEW ITEM REDEEM</h5>
                    <p class="text-center small">Enter details item Here</p>
                </div>



        <!-- Multi Columns Form -->
        <form id="priceForm" class="row g-3" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('item.redeem.store')}}">
  
          @csrf
          <div class="col-md-12">
            <label for="item" class="form-label">Item Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('item') is-invalid @enderror" value="{{  old('item') }}" name="item" id="item">
            @error('item')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
          </div>
  

  
          <div class="col-md-6">
            <label for="point" class="form-label">Item point <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('point') is-invalid @enderror" value="{{  old('point') }}" name="point" id="point">
            @error('point')
                <span class=" invalid-feedback mt-2">{{ $message }}</span>
            @enderror
          </div>
  

  
          <div class="col-md-12">
            <label for="description" class="form-label">Item Description <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{  old('description') }}" name="description" id="description">
            @error('description')
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

@endsection