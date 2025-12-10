
@extends('layouts.main')
 
@section('title', 'unsuspend page')
 
@section('content')

@include('partials.popup')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Point Of Sale</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('pos')}}">P.O.S</a></li>
                    <li class="breadcrumb-item active">Unsuspend</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        List suspend bill
    </div>
    <div class="card-body">
        <table id="datatable2" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Bill_id</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>#</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Bill_id</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>#</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach ($suspend as $row )
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$row->bill_id}}</td>
                        <?php 
                            if($row->cust_id)
                            {

                                $cust = DB::table('customers')->where('id',$row->cust_id)->first();
                            }
                            //dd($cust);
                        ?>
                        <td>{{$row->cust_id ? $cust->name : ''}}</td>
                        <td>{{round($row->total * 20) / 20}}</td>
                        <td>
                            <form onsubmit="confirmAndSubmit(this)" class="submit" action="{{route('pos.unsuspend')}}" method="post">
                                @csrf
                                
                                <input type="hidden" name="id" value="{{$row->id}}">
                                <button type="submit" class="btn btn-primary">Unsuspend</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


















