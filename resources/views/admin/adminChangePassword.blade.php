@extends("admin.admin_dashboard")

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">

   
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
              {{-- <h6 class="card-title mb-0">About</h6> --}}
              <div >
                <img class="wd-80 rounded-circle" style="margin-left: 5px"
                 src="
                {{(!empty($profileData->photo)) 
                ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg')
                
                }}" 
                alt="profile">
              <span class="h3 ms-3 " >{{$profileData->name}}</span>

              </div>

              {{-- <div class="dropdown">
                <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="git-branch" class="icon-sm me-2"></i> <span class="">Update</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View all</span></a>
                </div>
              </div> --}}
            </div>
            <p>Hi! I'm {{$profileData->name}} the Senior UI Designer at KhalifaSoft. We hope you enjoy the design and quality of Social.</p>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
              <p class="text-muted">{{$profileData->name}}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{$profileData->email}}</p>
            </div>

            @if (empty($profileData->address))
            <div class="mt-3" style="visibility: hidden">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                <p class="text-muted">{{$profileData->address}}</p>
              </div>
            @else
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                <p class="text-muted">{{$profileData->address}}</p>
              </div>
            @endif

            @if (empty($profileData->phone))
            <div class="mt-3" style="visibility: hidden">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                <p class="text-muted">{{$profileData->phone}}</p>
              </div>
            @else
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                <p class="text-muted">{{$profileData->phone}}</p>
              </div>
            @endif
            
           
            <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">


            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title">Change Password </h6>
  
                                  <form class="forms-sample" method="post"
                                   action="{{route("admin.update.password")}}"
                                   enctype="multipart/form-data">

                                   @csrf
                                     
                                      <div class="mb-3">
                                          <label for="exampleInputPassword1" class="form-label">Old Password</label>
                                          <input type="password" name="old_password" class="form-control 
                                          @error('old_password') isinvalid  @enderror"  
                                          id="old_password" autocomplete="off" placeholder="Password">
                                          @error('old_password')
                                              <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control 
                                        @error('new_password') isinvalid  @enderror"  
                                        id="new_password" autocomplete="off" placeholder="New Password">
                                        @error('new_password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Confirm New Password  </label>
                                                  <input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" autocomplete="off" placeholder="Confirm New Password" >
                                                                      
                                    
                                      
                                    </div>
                                    
                                      
                                      <button type="submit" class="btn btn-primary me-3">Change Password</button>
                                     
                                  </form>
  
                </div>
              </div>
            
          </div>
          
        </div>
      </div> 
      
   
@endsection