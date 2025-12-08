@extends('layouts.main')
 
@section('title', 'POS page')
 
@section('content')

@include('partials.popup')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Point Of Sale</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">P.O.S</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->


  <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        


        <div class="d-flex justify-content-between align-items-center">
            <div class="my-4 text-center">
                <!-- Extra Large modal -->
                <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl">Search Item</button>
            </div>
            <!--  Modal content for the above example -->
            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myExtraLargeModalLabel">Search Item</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table id="datatable" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead >
                                    <tr >
                                        <th>No</th>
                                        <th>Short Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Short Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>#</th>
                                        
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->shortcode}}</td>
                                            <td>{{$item->item}}</td>
                                            <td>{{$item->description}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>
                                                <form action="{{route('pos.add.item')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="shortcode" value="{{$item->shortcode}}">
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <div class="my-4 text-center">
                <!-- Extra Large modal -->
                <button type="button" class="btn btn-warning waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".searching-member">Search Member</button>
            </div>
            <!--  Modal content for the above example -->
            <div class="modal fade searching-member" tabindex="-1" role="dialog" aria-labelledby="search-member" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="search-member">Search Member</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Table with stripped rows -->
                            <table id="datatable2" class="table table-hover text-center table-bordered dt-responsive nowrap mt-2" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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

                                            <form action="{{route('pos.add.member')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$cust->id}}">
                                                <input type="hidden" name="phone" value="{{$cust->phone}}">
                                                <input type="hidden" name="name" value="{{$cust->name}}">
                                                <input type="hidden" name="email" value="{{$cust->email}}">
                                                <button type="submit" class="btn btn-primary rounded-pill waves-effect waves-light">add</button>
                                            </form>
                                        

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->



          <form class="text-end" autocomplete="off" action="{{route('pos.add.item')}}" method="post">
            @csrf
            <input class="  @error('category') is-invalid @enderror" type="text" value="{{  old('shortcode') }}" name="shortcode" placeholder="enter shortcode">
            <button class="btn btn-primary" type="submit">add</button>
          </form>
        </div>
    </div>

    

    <div class="card-body">
        name : {{ session('cust_name') }}
        email : {{ session('cust_email') }}
        id : {{ session('cust_id') }}
        <table id="" class="table table-bordered table-hover text-center table-responsive" >
            <thead >
                <tr >
                    <th>No</th>
                    <th>Short Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Discount</th>
                    <th>#</th>
                    <th>Subtotal Item</th>
                </tr>
            </thead>
            
            <tbody>
                @if (Cart::count() < 1)
                    <tr>
                        <td colspan="7">No entries found</td>
                    </tr>
                @else
                    
                    @foreach (Cart::content() as $row)
        
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>
                                {{$row->price}}
                            </td>
                            <td>
                                {{$row->qty}}
                            </td>
                            <td>
                                {{$row->options->discount}}%
                            </td>

                            <td>

                                <div class="my-4 text-center">
                                    
                                    
                                    <button  type="button" class="btn btn-primary waves-effect waves-light open-price-modal" data-bs-toggle="modal" data-bs-target="#modalTypeA" data-id="{{$row->id}}" data-rowid="{{$row->rowId}}" data-current-price="{{$row->price}}"></button>

                                    <button type="button" class="btn btn-success waves-effect waves-light open-quantity-modal" data-bs-toggle="modal" data-bs-target="#modalTypeB" data-id="{{$row->id}}" data-rowid="{{$row->rowId}}" data-current-quantity="{{$row->qty}}"></button>
                                    
                                    <button type="button" class="btn btn-warning waves-effect waves-light open-remark-modal" data-bs-toggle="modal" data-bs-target="#modalTypeC" data-id="{{$row->id}}" data-rowid="{{$row->rowId}}" data-current-remark="{{$row->options->remark}}"
                                        
                                        data-description="{{$row->options->description}}"
                                        data-cost="{{$row->options->cost}}"
                                        data-category="{{$row->options->category}}"
                                        data-discount="{{$row->options->discount}}"
                                        
                                        ></button>
                                    
                                    <form onsubmit="confirmAndSubmit(this)" action="{{route('pos.remove.item')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="rowid"  value="{{$row->rowId}}">
                                        <button type="submit" class="btn btn-danger"></button>
                                    </form>
                                </div>

                                <div class="btn-group m-0 p-0" role="group">

                                </div>
                                
                            </td>
                            <td rowspan="{{$loop->iteration}}">{{$row->subtotal()}}</td>
                        </tr>

                        @if ($row->options->remark !== '')
                            <tr>
                                <td colspan="7">{{$row->options->remark}}</td>
                            </tr>
                        @endif

                    @endforeach
                @endif
            </tbody>

            <tfoot>
                <tr >
                    <th  colspan="6">&nbsp;</th>
                    <th>Subtotal</th>
                    <th><?php echo Cart::subtotal(); ?></td>
                </tr>
                <tr>
                    <th colspan="6">&nbsp;</th>
                    <th>Tax</th>
                    <th><?php echo round(Cart::tax() * 20) / 20; ?></td>
                </tr>
                <tr>
                    <th colspan="6">&nbsp;</th>
                    <th>Total</th>
                    <th>            
                        <form class="mt-2 p-2"  action="" method="get">
                            @csrf
                            <div class=" mt-2">
                                <button class="{{Cart::total() <= 0 ? 'disabled':''}} btn btn-primary " type="submit"><?php echo round(Cart::total() * 20) / 20; ?></button>
                            </div>
                        </form>
                    </th>
                </tr>
    
                
            </tfoot>
        </table>

        <!-- update price modal-->
        <div class="modal fade" id="modalTypeA" tabindex="-1" role="dialog" aria-labelledby="modalTypeALabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTypeALabel">Modal Jenis A: Pendaftaran Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('pos.update.price')}}" method="post">
                            @csrf
                            <input type="hidden" id="itemIdPrice" name="id" value="">
                            <input type="hidden" id="rowIdPrice" name="rowid" value="">
                            <input type="text" class="form-control" id="currentPrice" name="price" value="">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('.open-price-modal').on('click', function() {
                    var itemId = $(this).data('id');           
                    var rowId = $(this).data('rowid');       
                    var currentPrice = $(this).data('current-price'); 
                    
                    $('#modalTypeALabel').text('Update Price Row: ' + itemId);
                    $('#itemIdPrice').val(itemId);
                    $('#rowIdPrice').val(rowId);
                    $('#currentPrice').val(currentPrice);

                    $('.bs-example-modal-center').modal('show'); 
                });
                
            });
        </script>


        <!-- update quantity modal-->
        <div class="modal fade" id="modalTypeB" tabindex="-1" role="dialog" aria-labelledby="modalTypeBLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTypeBLabel">Modal Jenis A: Pendaftaran Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('pos.update.quantity')}}" method="post">
                            @csrf
                            <input type="hidden" id="itemIdQuantity" name="id" value="">
                            <input type="hidden" id="rowIdQuantity" name="rowid" value="">
                            <input type="text" class="form-control" id="currentQuantity" name="quantity" value="">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('.open-quantity-modal').on('click', function() {
                    var itemId = $(this).data('id');           
                    var rowId = $(this).data('rowid');       
                    var currentQuantity = $(this).data('current-quantity'); 
                    
                    $('#modalTypeBLabel').text('Update Quantity Row: ' + itemId);
                    $('#itemIdQuantity').val(itemId);
                    $('#rowIdQuantity').val(rowId);
                    $('#currentQuantity').val(currentQuantity);

                    $('.bs-example-modal-center').modal('show'); 
                });
                
            });
        </script>

        <!-- update remark modal-->
        <div class="modal fade" id="modalTypeC" tabindex="-1" role="dialog" aria-labelledby="modalTypeCLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTypeCLabel">Modal Jenis A: Pendaftaran Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form onsubmit="confirmAndSubmit(this)" action="{{route('pos.update.remark')}}" method="post">
                            @csrf
                            <input type="hidden" id="rowIdRemark" name="rowid" value="">
                            <input type="hidden" id="description"name="description"  value="">
                            <input type="hidden" id="cost" name="cost"  value="">
                            <input type="hidden" id="category" name="category"  value="">
                            <input type="hidden" id="discount" name="discount"  value="">
                            <input type="text" class="form-control" id="currentRemark" name="remark" value="">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('.open-remark-modal').on('click', function() {   
                    var itemId = $(this).data('id');
                    var currentRemark = $(this).data('current-remark'); 
                    var rowId = $(this).data('rowid');       
                    var description = $(this).data('description');
                    var cost = $(this).data('cost'); 
                    var category = $(this).data('category'); 
                    var discount = $(this).data('discount');  
                    
                    $('#modalTypeCLabel').text('Update Remark Row: ' + itemId);
                    $('#rowIdRemark').val(rowId);
                    $('#currentRemark').val(currentRemark);
                    $('#description').val(description);
                    $('#cost').val(cost);
                    $('#category').val(category);
                    $('#discount').val(discount);

                    $('.bs-example-modal-center').modal('show'); 
                });
                
            });
        </script>

        <?php 
            $number = 7.26;

            // Multiply by 20, round to nearest integer, then divide by 20
            $rounded = round(Cart::total() * 20) / 20;

            //echo $rounded; // Output: 7.25
            ?>

        <?php $i = 0?>
        @foreach (Cart::content() as $row)
            <?php $i = $loop->iteration; ?>
        @endforeach
        <?php $u = 0?>
        @foreach ($suspend as $row)
            <?php $u = $loop->iteration; ?>
        @endforeach 

        <div class="card-footer d-flex text-center ">

      
              <form id="new_sale" class="mt-2 p-2" onsubmit="confirmAndSubmit(this)" action="{{route('pos.remove.all')}}" method="post">
                @csrf
                <div class=" mt-2 ">
                    <button class="{{$i >= 1 ? '':'disabled'}} btn btn-primary " type="submit">New Sales</button>
                </div>
              </form>
      
                <form id="suspend_bill" class="mt-2 p-2" onsubmit="confirmAndSubmit(this)" action="{{route('pos.suspend')}}" method="post">
                  @csrf
                  <input type="hidden" name="qty" value="{{$i}}">
                  <div class=" mt-2">
                    <button class="{{$i >= 1 ? '':'disabled'}} btn btn-primary " type="submit">Suspend Bill</button>
                  </div>
                </form>
      
                <form id="suspend_view" class="mt-2 p-2" onsubmit="confirmAndSubmit(this)" action="{{route('pos.suspend.list')}}" method="get">
                  @csrf
                  <input type="hidden" name="qty" value="{{$i}}">
                  <div class=" mt-2">
                    <button class="{{$u >= 1 ? '':'disabled'}} btn btn-primary " type="submit">Resume Suspend Bill</button>
                  </div>
                </form>

                <form  class="mt-2 p-2"  action="{{route('pos.quick.order.page')}}" method="get">
                    @csrf
                    
                    <div class=" mt-2">
                      <button class="{{$i < 1 ? '':'disabled'}} btn btn-primary " type="submit">Quick Order</button>
                    </div>
                  </form>
        </div>
        







    </div>
</div>

<script>
    document.addEventListener('keydown', function(event) {
        if (event.key === 'F1') {
            event.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ',
                cancelButtonText: 'cancel, '
            }).then((result) => {
                if (result.isConfirmed) {
                    // Place your custom code here
                    document.getElementById('new_sale').submit();
                }

            });//end sweet alert

        }//end if condition
    });//end keydown


    document.addEventListener('keydown', function(event) {
        if (event.key === 'F2') {
            event.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ',
                cancelButtonText: 'cancel, '
            }).then((result) => {
                if (result.isConfirmed) {
                    // Place your custom code here
                    document.getElementById('suspend_bill').submit();
                }

            });//end sweet alert

        }//end if condition
    });//end keydown


    document.addEventListener('keydown', function(event) {
        if (event.key === 'F3') {
            event.preventDefault();
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ',
                cancelButtonText: 'cancel, '
            }).then((result) => {
                if (result.isConfirmed) {
                    // Place your custom code here
                    document.getElementById('suspend_view').submit();
                }

            });//end sweet alert

        }//end if condition
    });//end keydown




    document.addEventListener('keydown', function(event) {
        if (event.key === 'F8') {
            event.preventDefault();
            
            // Place your custom code here
            document.getElementById('search_page').submit();

        }//end if condition
    });//end keydown



</script>

@endsection