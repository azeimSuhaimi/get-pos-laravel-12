@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">CUSTOMER</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('customer')}}">Customer</a></li>
                    <li class="breadcrumb-item active">View Details</li>
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
                    <a href="{{route('customer')}}" class="btn btn-primary mb-4">BACK</a>
                    <h5 class="card-title text-center pb-0 fs-4">CUSTOMER DETAILS</h5>
                    <p class="text-center small">Details customer Here</p>
                </div>
                

                <div class="row">
                    
                    <div class="col-xl-12">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">


                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Name</div>
                                    <div class="col-lg-9 col-md-8">{{$customer->name}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{$customer->email}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{$customer->phone}}</div>
                                    </div>

                                    

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{$customer->address}}</div>
                                    </div>
                            </div>
                        </div>

                        <div class="my-4 ">
                            <p class="text-muted"></p>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit Profile</button>
                        </div>

                        
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('customer.enter.member')}}" method="post">

                            @csrf
                            
                            <input type="hidden" name="id" value="{{$customer->id}}">
                            @error('id')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror

                            <div class="col-md-6 m-2">
                                <label for="invoice_id" class="form-label">Bill Invoice <span class="text-danger"></span></label>
                                <input type="text" class="form-control @error('invoice_id') is-invalid @enderror" value="{{old('invoice_id')}}" name="invoice_id" id="invoice_id">
                                @error('invoice_id')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>




                        
                        
                        <div class="pt-4 pb-2">
                            
                            <h5 class="card-title text-center pb-0 fs-4">LIST PURCHASE</h5>
                            <p class="text-center small">List Purchase Details are Here</p>
                        </div>

                        <!-- Table with stripped rows -->
                        <table id="datatable" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Shortcode</th>
                                <th>Name</th>
                                <th>price</th>
                                <th>quantity</th>
                                <th>date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($purchase_detail as $item)
                                
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->shortcode}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->created_at }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                        <h3 class="text-center"></h3>
                        <div class="pt-4 pb-2">
                            
                            <h5 class="card-title text-center pb-0 fs-4">LIST REDEEM</h5>
                            <p class="text-center small">List Items Redeem Details</p>
                        </div>

                        <!-- Table with stripped rows -->
                        <table id="datatable" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Point</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customeritemredeen as $row)
                                
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$row->name_item}}</td>
                                    <td>{{$row->description_item}}</td>
                                    <td>{{$row->point}}</td>
                                    <td>{{$row->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

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
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Profile Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--  Form -->
                    <form id="submit_profile" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('customer.update')}}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{$customer->id}}">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $customer->name }}" id="name" placeholder="">
                            @error('name')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $customer->email }}" id="email" placeholder="">
                            @error('email')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="phone"  type="text" class="form-control @error('phone') is-invalid @enderror" value="{{$customer->phone }}" id="phone">
                            
                            @error('phone')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                                                                        
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $customer->address }}" id="address" placeholder="">
                            @error('address')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>




                    </form><!-- End  Form -->




                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button form="submit_profile" class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit</button>
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>




@endsection