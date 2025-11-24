@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Employee</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('waste')}}">wASTE</a></li>
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

                <div class="row">

                    <div class="col-xl-8">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">


                                    <h5 class="card-title">Waste Details</h5>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Shortcode</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->shortcode}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Item</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->item}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Description</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->description}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Quantity</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->quantity}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">category</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->category == true ? 'Retail':'Non Retail'}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Cost</div>
                                    <div class="col-lg-9 col-md-8">RM {{$waste->cost}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Price Retail</div>
                                    <div class="col-lg-9 col-md-8">RM {{$waste->price}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Total</div>
                                    <div class="col-lg-9 col-md-8">RM {{$waste->cost * $waste->quantity}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Reason</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->reason}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Remark</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->remark}}</div>
                                    </div>

                                                                        
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date</div>
                                    <div class="col-lg-9 col-md-8">{{$waste->created_at }}</div>
                                    </div>



                            </div>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="col-sm-6 col-md-4 col-xl-3">


</div>




@endsection