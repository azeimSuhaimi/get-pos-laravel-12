@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Activity Log</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Activity Log</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">Activity Log</h4>
                                <p class="card-title-desc">My whole activity log history.
                                </p>

                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>activity</th>
                                        <th>date</th>
                                        <th>time</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($activity as $row)
                                            <tr>
                                                <td>{{$row->activity}}</td>
                                                <td>{{$row->date}}</td>
                                                <td>{{$row->time}}</td>
                                            </tr>
                                        @endforeach

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection