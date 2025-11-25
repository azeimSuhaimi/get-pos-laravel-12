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
                    <li class="breadcrumb-item active">View D.O</li>
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
                    <h5 class="card-title text-center pb-0 fs-4">D.O DETAILS</h5>
                    <p class="text-center small">Detail D.O Here</p>
                </div>
                

                <div class="row">


                    <div class="col-xl-4">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">

                                    <h5 class="card-title">D.O Details</h5>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">G.R.N No </div>
                                    <div class="col-lg-9 col-md-8">{{$do->grn_no}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date Receive</div>
                                    <div class="col-lg-9 col-md-8">{{$do->date_receive}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">D.O Number</div>
                                    <div class="col-lg-9 col-md-8">{{$do->do_number}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Supplier</div>
                                    <div class="col-lg-9 col-md-8">{{$do->supplier}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Receive By</div>
                                    <div class="col-lg-9 col-md-8">{{$do->receive_by}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Remark</div>
                                    <div class="col-lg-9 col-md-8">{{$do->remark }}</div>
                                    </div>

                                    
                                <div class="my-4 ">
                                    <p class="text-muted"></p>
                                    <!-- Large modal -->
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit Profile</button>
                                </div>


                            </div>
                        </div>



                    </div>

                    <div class="col-xl-8">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">
                                <table id="datatable" class="table text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Barcode</th>
                                            <th>Shortcode</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Cost</th>
                                            <th>Total</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ( $do_detail as $row)
                                            
                                            <tr>
                                                <td>{{$row->barcode}}</td>
                                                <td>{{$row->shortcode}}</td>
                                                <td>{{$row->item}}</td>
                                                <td>{{$row->quantity}}</td>
                                                <td>RM {{$row->cost}}</td>
                                                <td>RM {{$row->total}}</td>
                                                <td>{{$row->remark}}</td>
                                                
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
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
                    <form id="submit_profile" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('do.create.item')}}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{$do->id}}">
                        <input type="hidden" name="id" value="{{$do->id}}">
                        

                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-lg-3 col-form-label">Item Name/Barcode/SKU</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="code" type="text" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" id="code" placeholder="">
                            @error('code')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>


                        
                        <div class="row mb-3">
                            <label for="cost" class="col-md-4 col-lg-3 col-form-label">Cost Item</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="cost" type="text" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost') }}" id="cost" placeholder="">
                            @error('cost')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                                                
                        <div class="row mb-3">
                            <label for="quantity" class="col-md-4 col-lg-3 col-form-label">Quantity</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}" id="quantity" placeholder="">
                            @error('quantity')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                                                                        
                        <div class="row mb-3">
                            <label for="remark" class="col-md-4 col-lg-3 col-form-label">Remark</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="remark" type="text" class="form-control @error('remark') is-invalid @enderror" value="{{ old('remark') }}" id="remark" placeholder="">
                            @error('remark')
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