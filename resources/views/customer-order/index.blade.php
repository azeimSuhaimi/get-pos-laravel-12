@extends('layouts.main')
 
@section('title', ' page title')
 
@section('content')

@include('partials.popup')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Customer Order</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer Order</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

  


  <div class="card text-bg-light">
    <div class="card-body">
            
      <div class="pt-4 pb-2">
        <a href="{{route('customer.order.create')}}" class="btn btn-primary mb-2">Create</a>
          <h5 class="card-title text-center pb-0 fs-4">Search By Month</h5>
          <p class="text-center small">Select customer order Here</p>
      </div>


      

      <form class="row g-3" method="get" onsubmit="confirmAndSubmit(this)" action="{{route('customer.order')}}">

        @csrf
        <div class="row mb-3">
            <label for="date" class="col-md-4 col-lg-3 col-form-label">Date <span class="text-danger">*</span></label>
            <div class="col-md-8 col-lg-9">
              <input name="date" id="date" type="month" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ $date == null ? '':$date }}">
              @error('date')
                  <span class=" invalid-feedback mt-2">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <script>
            const monthInput = document.querySelector("#date");
          
            // Set the maximum allowed month to the current month (no future months allowed)
            function updateMonthLimits() {
              const today = new Date();
              const formattedMonth = today.toISOString().slice(0, 7); // format as YYYY-MM
              monthInput.max = formattedMonth; // No future months allowed
              monthInput.min = "1900-01"; // Adjust the min month as needed (e.g., 1900-01 or the earliest valid month)
            }
          
            // Call the function to initialize the input on page load
            updateMonthLimits();
          </script>
          


        <div class="text-center">
          <button type="submit" class="btn btn-primary">Search</button>
          <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
      </form>

        <h5 class="card-title text-center pb-0 fs-4 mt-4">All Customer Order {{$date == null ? \Carbon\Carbon::now()->format('F Y'):\Carbon\Carbon::parse($date)->format('F Y')}}</h5>
        <p class="text-center small">List all customer order .</p>

        <!-- Table with stripped rows -->
        <table id="datatable" class="table text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
          <thead>
            <tr>
                
                <th>Date</th>
                <th>Name.</th>
                <th>Phone</th>
                
                <th>Item</th>
                <th>Remark</th>
                <th>#</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($customer_order as $row)
              
              <tr>
                  
                  <td>{{\Carbon\Carbon::parse($row->created_at)->format('d-m-y')}}</td>
                  <td>{{$row->name}}</td>
                  <td>{{$row->phone}}</td>
                  
                  <td>{{$row->item}}</td>
                  <td>{{$row->remark}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      @if ($row->contact == false)
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('customer.order.update.contact')}}" method="post">
                          @csrf
                          <input type="hidden" name='id' value="{{$row->id}}">
                          <button class="btn btn-primary" type="submit">Contact</button>
                        </form>
                      @else
                        <button class="btn btn-success">Contact Checked </button>
                      @endif

                      @if ($row->status == false)
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('customer.order.update.status')}}" method="post">
                          @csrf
                          <input type="hidden" name='id' value="{{$row->id}}">
                          <button class="btn btn-primary" type="submit">pickup</button>
                        </form>
                      @else
                        <button class="btn btn-success">pick up Checked</button>
                      @endif


                      @if ($row->status == false)
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('customer.order.remove')}}" method="post">
                          @csrf
                          <input type="hidden" name='id' value="{{$row->id}}">
                          <button class="btn btn-danger" type="submit">Remove</button>
                        </form>
                      @endif
                    </div>

                        
                  </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div>
</div>


@endsection