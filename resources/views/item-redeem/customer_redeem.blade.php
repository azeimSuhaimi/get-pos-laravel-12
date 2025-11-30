@extends('layouts.main')
 
@section('title', 'cash method page')
 
@section('content')

@include('partials.popup')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Items</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('item.redeem')}}">List Item Redeem</a></li>
                    <li class="breadcrumb-item active">Redeem Items </li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card mb-4">

    <div class="card-body">
<a href="{{route('item.redeem')}}" class="btn btn-primary mb-4">BACK</a>

        <div class="row d-flex justify-content-center align-items-cente">

            <h6 class="card-title text-center text-uppercase font-weight-bold">Customer Redeem</h6>

            <div class="col-md-5">
                <div class="">
        
                    <h5 class="card-title text-center text-uppercase font-weight-bold">Item : {{$items->item}}</h5>
                </div>
    
                <div class="">
                    <h5 class="card-title text-center text-uppercase font-weight-bold">Description : {{$items->description}}</h5>
                </div>
        
                <div class="">
                    <h5 class="card-title text-center text-uppercase font-weight-bold">Point : {{$items->point}}</h5>
                </div>

                <div class="">
                    <h5 id="displayText" class="card-title text-center text-uppercase font-weight-bold @error('item_status') text-danger @enderror">Status : {{$items->status == true ? 'Active':'Deactive'}}</h5>
                    @error('item_status')
                        <span class="text-danger text-center text-uppercase">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-5 ">
                
                <form id="cash" onsubmit="confirmAndSubmit(this)"  action="{{route('item.redeem.redeen')}}" method="post">
                    @csrf

                    <input type="hidden" name="item_status" value="{{$items->status}}">
                    <input type="hidden" name="item_point" value="{{$items->point}}">
            
                    <input type="hidden" name="id" value="{{$request->input('id')}}">

                    <input type="hidden" name="id_cust" value="{{ ($request->has('id_cust') ? $request->input('id_cust'):'') }}">
                    
                    <div class="mb-3">
                  
                        <input type="text" class="form-control @error('name_cust') is-invalid @enderror" name="name_cust" id="name_cust" value="{{ ($request->has('name') ? $request->input('name'):'') }}" placeholder="Name Customer" readonly>
                        @error('name_cust')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        
                        <input type="email" class="form-control @error('email_cust') is-invalid @enderror" name="email_cust" id="email_cust" value="{{ ($request->has('email') ? $request->input('email'):'') }}" placeholder="email Customer" readonly>
                        @error('email_cust')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        
                        <input type="tel" class="form-control @error('phone_cust') is-invalid @enderror" name="phone_cust" id="phone_cust" value="{{ ($request->has('phone') ? $request->input('phone'):'') }}" placeholder="Phone Customer" readonly>
                        @error('phone_cust')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>
            
                    <div class="mb-3">
                        
                        <input type="text" class="form-control @error('point_customer') is-invalid @enderror" name="point_customer" id="point_customer" value="{{ ($request->has('point') ? $request->input('point'):'') }}" placeholder="Amount Tendered" readonly>
                        @error('point_customer')
                            <span class=" invalid-feedback mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </form>
        
            </div>

            
            <div class="d-grid mt-2"><button form="cash" class="btn btn-primary btn-block" type="submit">Submit</button></div>
                <!-- Button to set exact amount -->
                        <div class="my-4 ">
                            <p class="text-muted"></p>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Search Member</button>
                        </div>
            
                        <!--  Modal content for the above example -->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myLargeModalLabel">List Member</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Search Customer
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div class="col-md-12">
                        
                                        
                                        <h5 class="card-title">All Customer</h5>
                                        <p>List all Customer.</p>
                            
                                        <!-- Table with stripped rows -->
                                        <table id="datatable" class="table table-responsive table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                
                                                <th>Name</th>
                                                <th>Phone.</th>
                                                <th>Email</th>
                                                <th>Point</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customerList as $cust)
                                            
                                            <tr>
                                                
                                                <td>{{$cust->name}}</td>
                                                <td>{{$cust->phone}}</td>
                                                <td>{{$cust->email}}</td>
                                                <td>{{$cust->point}}</td>
                                                <td>
                                                        <form action="{{route('item.redeem.customer_redeem')}}" method="get">
                                                            <input type="hidden" name="id" value="{{$request->input('id')}}">
                                                            <input type="hidden" name="id_cust" value="{{$cust->id}}">
                                                            <input type="hidden" name="phone" value="{{$cust->phone}}">
                                                            <input type="hidden" name="name" value="{{$cust->name}}">
                                                            <input type="hidden" name="email" value="{{$cust->email}}">
                                                            <input type="hidden" name="point" value="{{$cust->point}}">
                                                            <button type="submit" class="btn btn-primary rounded-pill waves-effect waves-light">add</button>
                                                        </form>
                                                    

                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                        <!-- End Table with stripped rows -->

                                    </div>

                                </div>
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


        </div>
    </div>
</div>

@endsection