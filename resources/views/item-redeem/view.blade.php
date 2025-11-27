@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Items Redeem</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('item.redeem')}}">Item Redeem</a></li>
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
                    <a href="{{route('item.redeem')}}" class="btn btn-primary mb-4">BACK</a>
                    <h5 class="card-title text-center pb-0 fs-4"> DETAILS ITEM REDEEM</h5>
                    <p class="text-center small">Detail item redeem Here</p>
                </div>

                <div class="row">
                    <div class="col-xl-4">

                        <div class="card text-bg-light">
                        <div class="card-body  pt-4  align-items-center">

                            <img download src="image/item/empty.png" alt="Profile" class=" img-fluid ">

                            <a download="" href="image/item/empty.png"> down</a>

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
                                    <div class="col-lg-3 col-md-4 label">Description</div>
                                    <div class="col-lg-9 col-md-8">{{$item->description}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Point</div>
                                    <div class="col-lg-9 col-md-8">{{$item->point}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Category</div>
                                    <div class="col-lg-9 col-md-8">{{$item->status ? 'Active':'Non Active'}}</div>
                                    </div>

                            </div>
                        </div>

                        <div class="my-4 ">
                            <p class="text-muted"></p>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit Profile</button>
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
                    <form id="submit_profile" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('item.redeem.update')}}" >

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
                            <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $item->description }}" id="description" placeholder="">
                            @error('description')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="point" class="col-md-4 col-lg-3 col-form-label">Point</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="point" type="text" class="form-control @error('point') is-invalid @enderror" value="{{ $item->point }}" id="point" placeholder="">
                            @error('point')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>




                        <!-- 
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>-->


                    </form><!-- End  Form -->



                    <form id="item_status" onsubmit="confirmAndSubmit(this)" action="{{route('item.redeem.status')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        
                    </form>




                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button form="submit_profile" class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit</button>
                                
                                <button form="item_status" type="submit"  class="btn btn-info w-100 waves-effect waves-light mt-2">Status</button>
                                
                            
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>




@endsection