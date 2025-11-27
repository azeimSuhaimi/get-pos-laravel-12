@extends('layouts.main')
 
@section('title', 'All Item reden page')
 
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
                    <li class="breadcrumb-item active">Items Redeem</li>
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
                  <a href="{{route('item.redeem.create')}}" class="btn btn-primary mb-3">ADD ITEM </a>
                    
                    <h5 class="card-title text-center pb-0 fs-4">All Items Redeem</h5>
                    <p class="text-center small">List all  items redeem Here</p>
                </div>


            <!-- Table with stripped rows -->
            <table class="table datatable table-hover ">
              <thead >
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Point</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
              </thead>
              <tbody>
                @foreach ($itemredeen as $row)
                  
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$row->item}}</td>
                      <td>{{$row->description}}</td>
                      <td>{{$row->point}}</td>
                      <td>{{$row->status == true ? 'Active':'Deactive'}}</td>
                      <td>
                        <div class="btn-group" role="group" >
                          <a href="{{route('item.redeem.customer_redeem')}}?id={{$row->id}}" class="btn btn-success">Redeem</a>
                          <a href="{{route('item.redeem.view')}}?id={{$row->id}}" class="btn btn-info">View</a>
                          
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