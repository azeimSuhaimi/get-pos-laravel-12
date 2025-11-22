@extends('layouts.main')
 
@section('title', 'Page Title')
@section('content')

@include('partials.popup')
    
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Employee</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Employee</li>
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

                <h4 class="card-title">Employeee List</h4>
                <p class="card-title-desc"></code>.
                </p>

                <a href="{{route('employee.create.page')}}" class="btn btn-primary ">Create</a>

                <table id="datatable" class="table text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Work Id</th>
                        <th>I.C</th>
                        <th>Position</th>
                        <th>#</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach ( $employee as $row)
                        
                        <tr>
                            <td>{{$row->work_id}}</td>
                            <td>{{$row->ic}}</td>
                            <td>{{$row->position}}</td>
                            <td><a href="{{route('employee.view')}}?id={{$row->user_id}}" class="btn btn-info ">View</a></td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection