@extends('layouts.main')
 
@section('title', 'expense page')
 
@section('content')

@include('partials.popup')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">EXPENSE</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Expense</li>
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
                <a href="{{route('expense.create')}}" class="btn btn-primary ">Create</a>
                <h5 class="card-title text-center pb-0 fs-4">All Expense</h5>
                <p class="text-center small">List all expense Here</p>
            </div>

            <!-- Table with stripped rows -->
            <table d="datatable" class="table text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Date Expense</th>
                    <th>Description.</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($expense as $exp)
                  
                  <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$exp->date}}</td>
                      <td>{{$exp->description}}</td>
                      <td>{{$exp->amount}}</td>
                      <td>
                        <a href="{{route('expense.view')}}?id={{$exp->id}}" class="btn btn-primary ">View Details</a>
                            
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