@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Expense</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('expense')}}">Expense</a></li>
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
                    <a href="{{route('expense')}}" class="btn btn-primary mb-4">BACK</a>
                    <h5 class="card-title text-center pb-0 fs-4"> DETAILS EXPENSE</h5>
                    <p class="text-center small">Detail expense Here</p>
                </div>

                <div class="row">

                    <div class="col-xl-8">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">


                                    <h5 class="card-title">Expense Details</h5>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Description</div>
                                    <div class="col-lg-9 col-md-8">{{$expense->description}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Notes</div>
                                    <div class="col-lg-9 col-md-8">{{$expense->notes}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Receipt</div>
                                    <div class="col-lg-9 col-md-8">{{$expense->receipt}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date Expense</div>
                                    <div class="col-lg-9 col-md-8">{{$expense->date}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">amount</div>
                                    <div class="col-lg-9 col-md-8">RM {{$expense->amount }}</div>
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