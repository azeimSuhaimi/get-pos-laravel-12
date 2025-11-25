@extends('layouts.main')
 
@section('title', 'customer page')
 
@section('content')

@include('partials.popup')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">All Customer</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card text-bg-light">
            <div class="card-body">
                
                            
                <div class="pt-4 pb-2">
                    <a href="{{route('customer.create')}}" class="btn btn-primary mb-2">ADD CUSTOMER</a>
                    <h5 class="card-title text-center pb-0 fs-4">ALL CUSTOMER</h5>
                    <p class="text-center small">List All customer are Here</p>
                </div>

                <!-- Table with stripped rows -->
                <table id="datatable" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Phone.</th>
                        <th>Email</th>
                        <th>Point</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customer as $cust)
                    
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$cust->name}}</td>
                        <td>{{$cust->phone}}</td>
                        <td>{{$cust->email}}</td>
                        <td>{{$cust->point}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('customer.view')}}?id={{$cust->id}}" class="btn btn-info  ">view Details</a>
                            </div>
                                
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
  </section>

@endsection