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
                    <li class="breadcrumb-item"><a href="{{route('item')}}">Item</a></li>
                    <li class="breadcrumb-item active">View</li>
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
                    <a href="{{route('item')}}" class="btn btn-primary mb-4">BACK</a>
                    <h5 class="card-title text-center pb-0 fs-4"> DETAILS ITEM</h5>
                    <p class="text-center small">Detail item Here</p>
                </div>

                <div class="row">
                    <div class="col-xl-4">

                        <div class="card text-bg-light">
                        <div class="card-body  pt-4  align-items-center">

                            <img src="image/item/{{$item->picture}}" alt="Profile" class=" img-fluid ">

                        </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">


                                    <h5 class="card-title">Item Details</h5>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Item Name</div>
                                    <div class="col-lg-9 col-md-8">{{$item->item}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Barcode</div>
                                    <div class="col-lg-9 col-md-8">{{$item->barcode}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Shortcode</div>
                                    <div class="col-lg-9 col-md-8">{{$item->shortcode}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Description</div>
                                    <div class="col-lg-9 col-md-8">{{$item->description}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Quantity</div>
                                    <div class="col-lg-9 col-md-8">{{$item->quantity}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Category</div>
                                    <div class="col-lg-9 col-md-8">{{$item->category ? 'Retail':'Non Retail'}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Cost Item</div>
                                    <div class="col-lg-9 col-md-8">RM {{$item->cost}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Price Item</div>
                                    <div class="col-lg-9 col-md-8">RM {{$item->price}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Discount</div>
                                    <div class="col-lg-9 col-md-8">{{$item->discount}}%</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Discount Expired</div>
                                    <div class="col-lg-9 col-md-8">{{$item->expired_date}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Quick Order status</div>
                                    <div class="col-lg-9 col-md-8">{{$item->quickorder_status ? 'Open':'Closed'}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8">{{$item->deleted_at ? 'Non Active':'Active'}}</div>
                                    </div>

                            </div>
                        </div>

                        <div class="my-4 ">
                            <p class="text-muted"></p>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit Details</button>

                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg-discount">Edit Discount</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="col-sm-6 col-md-4 col-xl-3">



    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--  Form -->
                    <form id="submit_profile" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('item.update.')}}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        

                        <div class="row mb-3">
                            <label for="item" class="col-md-4 col-lg-3 col-form-label">Item Name</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="item" type="text" class="form-control @error('item') is-invalid @enderror" value="{{ $item->item }}" id="item" placeholder="">
                            @error('item')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="barcode" class="col-md-4 col-lg-3 col-form-label">Barcode</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="barcode" type="text" class="form-control @error('barcode') is-invalid @enderror" value="{{ $item->barcode }}" id="barcode" placeholder="">
                            @error('barcode')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="shortcode" class="col-md-4 col-lg-3 col-form-label">Short Code</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="shortcode"  type="text" class="form-control @error('shortcode') is-invalid @enderror" value="{{$item->shortcode }}" id="shortcode">
                            
                            @error('shortcode')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="cost" class="col-md-4 col-lg-3 col-form-label">Cost Item</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="cost" type="text" class="form-control @error('cost') is-invalid @enderror" value="{{ $item->cost }}" id="cost" placeholder="">
                            @error('cost')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                                                
                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-lg-3 col-form-label">Retail Price</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="price" type="text" class="form-control @error('price') is-invalid @enderror" value="{{ $item->price }}" id="price" placeholder="">
                            @error('price')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                                                                        
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $item->description }}" id="description" placeholder="">
                            @error('description')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                                                                                                
                        <div class="row mb-3">
        
                            
                                <label for="category" class="col-md-4 col-lg-3 col-form-label">Category <span class="text-danger">*</span></label>
                                <div class="form-check mb-3 col-md-4">
                                <input class="form-check-input  @error('category') is-invalid @enderror" type="radio" name="category" id="category" value="1"  {{$item->category == '1' ? 'checked' : ''}}>
                                <label class="form-check-label" for="category">
                                Retail
                                </label>
                                </div>
                                <div class="form-check mb-3 col-md-4">
                                <input class="form-check-input  @error('category') is-invalid @enderror" type="radio" name="category" id="category_non" value="0" {{$item->category == '0' ? 'checked' : ''}}>
                                <label class="form-check-label" for="category_non">
                                    Non Retail
                                    </label>
                                </div>
                                @error('category')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            
                        </div>

                        <div class="row mb-3">
                            <label for="file-input" class="col-md-4 col-lg-3 col-form-label">Select Files Here</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="file" type="file" class="form-control @error('file') is-invalid @enderror"  id="file-input">
                            @error('file')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image-preview" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                                <img class="img-fluid w-25" src="{{asset('image/item/'.$item->picture)}} " id="image-preview" alt="Profile">
                            </div>
                        </div>

                        <!-- 
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>-->


                    </form><!-- End  Form -->

                    <form id="remove_image" onsubmit="confirmAndSubmit(this)" action="{{route('item.remove.image')}}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                    </form>

                    <form id="item_status" onsubmit="confirmAndSubmit(this)" action="{{route('item.status')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        
                    </form>

                    <form id="item_status_quick" onsubmit="confirmAndSubmit(this)" action="{{route('item.status.quick')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        
                    </form>


                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button form="submit_profile" class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit</button>
                                <button form="remove_image" type="submit"  class="btn btn-danger w-100 waves-effect waves-light mt-2">Remove Image</button>
                                <button form="item_status" type="submit"  class="btn btn-info w-100 waves-effect waves-light mt-2">Status</button>
                                <button form="item_status_quick" type="submit"  class="btn btn-info w-100 waves-effect waves-light mt-2">Status Quick Order</button>
                            
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!--  Modal content for the above discount -->
    <div class="modal fade bs-example-modal-lg-discount" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabelDiscount" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabelDiscount">Edit Discount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--  Form -->
                    <form method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('item.update.discount.')}}" >

                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        

                        <div class="row mb-3">
                            <label for="discount" class="col-md-4 col-lg-3 col-form-label">Discount %</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="discount" type="text" class="form-control @error('discount') is-invalid @enderror" value="{{ $item->discount }}" id="discount" placeholder="">
                            @error('discount')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="expired_date" class="col-md-4 col-lg-3 col-form-label">Discount Expired</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="expired_date" type="date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ $item->expired_date }}" id="expired_date" placeholder="">
                            @error('expired_date')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit</button>
                    </form><!-- End  Form -->




                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">

                            
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>


<script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');
    
    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function () {
          imagePreview.src = reader.result;
          //imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        //imagePreview.style.display = 'none';
      }
    });
    
    
    
</script>

@endsection