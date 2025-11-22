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
                    <li class="breadcrumb-item"><a href="{{route('employee')}}">Employee</a></li>
                    <li class="breadcrumb-item active">View</li>
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
                    <div class="col-xl-4">

                        <div class="card text-bg-light">
                        <div class="card-body  pt-4  align-items-center">

                            <img src="image/profile/{{$user->picture}}" alt="Profile" class=" img-fluid ">
                            <div class="social-links mt-2">
                            <!--
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            -->
                            </div>
                        </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card text-bg-light">
                            <div class="card-body pt-3">


                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Name</div>
                                    <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{$user->phone}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Last Login</div>
                                    <div class="col-lg-9 col-md-8">{{$user->last_login}}</div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Date Register</div>
                                    <div class="col-lg-9 col-md-8">{{$user->date_register}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">I.C</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->ic}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Work ID</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->work_id}}</div>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->address}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Sacond Address</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->address2}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Gender</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->gender}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Birthday</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->birthday}}</div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Position</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->position}}</div>
                                    </div>
                                                                        
                                    <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                    <div class="col-lg-9 col-md-8">{{$employee->status == true ? 'Active':'Resign'}}</div>
                                    </div>



                            </div>
                        </div>

                        <div class="my-4 ">
                            <p class="text-muted"></p>
                            <!-- Large modal -->
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-lg">Edit Profile</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<div class="col-sm-6 col-md-4 col-xl-3">



    <!--  Modal content for the above example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--  Form -->
                    <form id="submit_profile" method="POST" onsubmit="confirmAndSubmit(this)" action="{{route('employee.update.profile')}}" enctype="multipart/form-data">

                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input type="hidden" name="employee_id" value="{{$employee->id}}">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" id="name" placeholder="">
                            @error('name')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" id="email" placeholder="">
                            @error('email')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="phone"  type="text" class="form-control @error('phone') is-invalid @enderror" value="{{$user->phone }}" id="phone">
                            
                            @error('phone')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="ic" class="col-md-4 col-lg-3 col-form-label">I.C</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="ic" type="text" class="form-control @error('ic') is-invalid @enderror" value="{{ $employee->ic }}" id="ic" placeholder="">
                            @error('ic')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                                                
                        <div class="row mb-3">
                            <label for="work_id" class="col-md-4 col-lg-3 col-form-label">Work I.D</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="work_id" type="text" class="form-control @error('work_id') is-invalid @enderror" value="{{ $employee->work_id }}" id="work_id" placeholder="">
                            @error('work_id')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                                                                        
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $employee->address }}" id="address" placeholder="">
                            @error('address')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                                                                                                
                        <div class="row mb-3">
                            <label for="address2" class="col-md-4 col-lg-3 col-form-label">Second Address</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="address2" type="text" class="form-control @error('address2') is-invalid @enderror" value="{{ $employee->address2 }}" id="address2" placeholder="">
                            @error('address2')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                                                                                                
                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-lg-3 col-form-label">Birthday</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" value="{{ $employee->birthday }}" id="birthday" placeholder="">
                            @error('birthday')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputState" class="col-md-4 col-lg-3 col-form-label">Position </label>
                            <div class="col-md-8 col-lg-9">
                                <select name="position" class="form-select @error('position') is-invalid @enderror">
                                    <option value="" selected>Choose...</option>
                                    <option value="staff" @selected($employee->position === 'staff')>Staff</option>
                                    <option value="cashier" @selected($employee->position === 'cashier')>Cashier</option>
                                    <option value="retail" @selected($employee->position === 'retail')>Retail</option>
                                    <option value="supervisor" @selected($employee->position === 'supervisor')>supervisor</option>
                                </select>
                                @error('position')
                                    <span class=" invalid-feedback mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gender" class="col-md-4 col-lg-3 col-form-label">Gender <span class="text-danger">*</span></label>
                            <div class="form-check col-md-4">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="male"  {{$employee->gender === 'male' ? 'checked' : ''}}>
                                <label class="form-check-label" for="gender">
                                Male
                                </label>
                            </div>
                            <div class="form-check col-md-4">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="female" {{$employee->gender === 'female' ? 'checked' : ''}}>
                                <label class="form-check-label" for="gender">
                                    Female
                                </label>
                            </div>
                            @error('gender')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="file-input" class="col-md-4 col-lg-3 col-form-label">Select Files Here</label>
                            <div class="col-md-8 col-lg-9">
                            <input name="file" type="file" class="form-control @error('file') is-invalid @enderror"  id="file-input">
                            @error('file')
                                <span class=" invalid-feedback mt-2">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image-preview" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                                <img class="img-fluid w-25" src="{{asset('image/profile/'.$user->picture)}} " id="image-preview" alt="Profile">
                            </div>
                        </div>

                        <!-- 
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>-->


                    </form><!-- End  Form -->

                    <form id="remove_image" onsubmit="confirmAndSubmit(this)" action="{{route('employee.remove.image')}}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                    </form>

                    <form id="employee_status" onsubmit="confirmAndSubmit(this)" action="{{route('employee.status')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input type="hidden" name="employee_id" value="{{$employee->id}}">
                    </form>

                        <div class="form-group mb-3 text-center row mt-3 pt-1">
                            <div class="col-12">
                                <button form="submit_profile" class="btn btn-info w-100 waves-effect waves-light" type="submit">Submit</button>
                                <button form="remove_image" type="submit"  class="btn btn-danger w-100 waves-effect waves-light mt-2">Remove Image</button>
                                <button form="employee_status" type="submit"  class="btn btn-info w-100 waves-effect waves-light mt-2">status</button>
                            </div>
                        </div>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>


<script>
    const fileInput = document.getElementById('file-input');
    const imagePreview = document.getElementById('image-preview');
    
    fileInput.addEventListener('change', function () {
      const file = fileInput.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function () {
          imagePreview.src = reader.result;
          //imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      } else {
        //imagePreview.style.display = 'none';
      }
    });
    
    
    
</script>

@endsection