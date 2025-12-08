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
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Items</li>
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
                    <h5 class="card-title text-center pb-0 fs-4">LIST ITEMS</h5>
                    <p class="text-center small">List all items Here</p>
                </div>

                <a href="{{route('item.create.page')}}" class="btn btn-primary ">Create</a>

                <table id="datatable" class="table text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Short Code</th>
                            <th>Items</th>
                            <th>Category</th>
                            <th>#</th>
                        </tr>
                    </thead>


                    <tbody>
                    @foreach ( $items as $row)
                        
                        <tr>
                            <td>{{$row->shortcode}}</td>
                            <td>{{$row->item}}</td>
                            <td>{{$row->category ? 'Retail':'Non Retail'}}</td>
                            <td><a href="{{route('item.view')}}?id={{$row->id}}" class="btn btn-info ">View</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <div class="pt-4 pb-2">
                    <a href="{{route('do.create.page')}}" class="btn btn-primary ">Create</a>
                    <h5 class="card-title text-center pb-0 fs-4">LIST D.O</h5>
                    <p class="text-center small">List all D.O items Here</p>
                </div>
                

                <table id="datatable" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>GRN No</th>
                            <th>Date Receive</th>
                            <th>D.O No</th>
                            <th>Supplier</th>
                            <th>#</th>
                        </tr>
                    </thead>


                    <tbody>
                    @foreach ( $do as $row)
                        
                        <tr>
                            <td>{{$row->grn_no}}</td>
                            <td>{{$row->date_receive}}</td>
                            <td>{{$row->do_number}}</td>
                            <td>{{$row->supplier}}</td>
                            <td><a href="{{route('do.view')}}?id={{$row->id}}" class="btn btn-info ">View</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection