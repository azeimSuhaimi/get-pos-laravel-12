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
                <!-- Multi Columns Form -->
                <a href="{{route('item')}}" class="btn btn-primary ">BACK</a>

                <form id="priceForm" class="row g-3" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('item.create.store')}}">
        
                @csrf
                <div class="col-md-12">
                    <label for="item" class="form-label">Item Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('item') is-invalid @enderror" value="{{  old('item') }}" name="item" id="item">
                    @error('item')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="shortcode" class="form-label">Item Shortcode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('shortcode') is-invalid @enderror" value="{{  old('shortcode') }}" name="shortcode" id="shortcode">
                    @error('shortcode')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="barcode" class="form-label">Item Barcode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('barcode') is-invalid @enderror" value="{{  old('barcode') }}" name="barcode" id="barcode">
                    @error('barcode')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="cost" class="form-label">Item Cost <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('cost') is-invalid @enderror" value="{{  old('cost') }}" name="cost" id="cost">
                    @error('cost')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
                <div class="col-md-6">
                    <label for="price" class="form-label">Item Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{  old('price') }}" name="price" id="price">
                    @error('price')
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
        

        
                <div class="col-md-4">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                    <div class="form-check mb-3">
                    <input class="form-check-input @error('category') is-invalid @enderror" type="radio" name="category" id="category" value="1"  {{old('category') == '1' ? 'checked' : ''}}>
                    <label class="form-check-label" for="category">
                    Retail
                    </label>
                    </div>
                    <div class="form-check mb-3">
                    <input class="form-check-input @error('category') is-invalid @enderror" type="radio" name="category" id="category_non" value="0" {{old('category') == '0' ? 'checked' : ''}}>
                    <label class="form-check-label" for="category_non">
                        Non Retail
                        </label>
                    </div>
                    @error('category')
                        <span class=" invalid-feedback mt-2">{{ $message }}</span>
                    @enderror
                </div>
        
        
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form><!-- End Multi Columns Form -->

                <script>
                    document.getElementById('priceForm').addEventListener('submit', function(event) {
                        // Get the values of cost and price
                        let cost = parseFloat(document.getElementById('cost').value);
                        let price = parseFloat(document.getElementById('price').value);
                        
                        // Check if cost is greater than price or price is less than cost
                        if (cost > price) {
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Cost cannot be greater than price.",
                            });
                            event.preventDefault();  // Prevent form submission
                        } else if (price < cost) {
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Price cannot be less than cost.",
                            });
                            alert('');
                            event.preventDefault();  // Prevent form submission
                        }
                    });
                </script>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection