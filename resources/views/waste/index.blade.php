@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Waste</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Waste</li>
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
                    <a href="{{route('waste.create.page')}}" class="btn btn-primary ">Create</a>
                    <h5 class="card-title text-center pb-0 fs-4"> LIST ALL WASTE</h5>
                    <p class="text-center small">List all waste Here</p>
                </div>


                <table id="datatable" class="table text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Shortcode </th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>created_at</th>
                        <th>#</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach ( $waste as $row)
                        
                        <tr>
                            <td>{{$row->shortcode}}</td>
                            <td>{{$row->item}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>{{$row->cost}}</td>
                            <td>{{$row->created_at}}</td>
                            <td><a href="{{route('waste.view')}}?id={{$row->id}}" class="btn btn-info ">View</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection