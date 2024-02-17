@extends("agent.agent_dashboard")

@section('agent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">

    {{-- <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="position-relative">
            <figure class="overflow-hidden mb-0 d-flex justify-content-center">
              <img src="https://via.placeholder.com/1560x370"class="rounded-top" alt="profile cover">
            </figure>
            <div class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
              <div>
                <img class="wd-70 rounded-circle" src="https://via.placeholder.com/100x100" alt="profile">
                <span class="h4 ms-3 text-dark">Amiah Burton</span>
              </div>
              <div class="d-none d-md-block">
                <button class="btn btn-primary btn-icon-text">
                  <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                </button>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-center p-3 rounded-bottom">
            <ul class="d-flex align-items-center m-0 p-0">
              <li class="d-flex align-items-center active">
                <i class="me-1 icon-md text-primary" data-feather="columns"></i>
                <a class="pt-1px d-none d-md-block text-primary" href="#">Timeline</a>
              </li>
              <li class="ms-3 ps-3 border-start d-flex align-items-center">
                <i class="me-1 icon-md" data-feather="user"></i>
                <a class="pt-1px d-none d-md-block text-body" href="#">About</a>

              </li>
              <li class="ms-3 ps-3 border-start d-flex align-items-center">
                <i class="me-1 icon-md" data-feather="users"></i>
                <a class="pt-1px d-none d-md-block text-body" href="#">Friends <span class="text-muted tx-12">3,765</span></a>
              </li>
              <li class="ms-3 ps-3 border-start d-flex align-items-center">
                <i class="me-1 icon-md" data-feather="image"></i>
                <a class="pt-1px d-none d-md-block text-body" href="#">Photos</a>
              </li>
              <li class="ms-3 ps-3 border-start d-flex align-items-center">
                <i class="me-1 icon-md" data-feather="video"></i>
                <a class="pt-1px d-none d-md-block text-body" href="#">Videos</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div> --}}
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
                ? url($profileData->photo) : url('upload/no_image.jpg')
                
                }}" 
                alt="profile">
              <span class="h3 ms-3 " >{{$profileData->name}}</span>

              </div>

              
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
  
                                  <h6 class="card-title">Update Agent Profile</h6>
  
                                  <form class="forms-sample" method="post"
                                   action="{{route("agent.profile.store")}}"
                                   enctype="multipart/form-data">

                                   @csrf
                                      <div class="mb-3">
                                          <label for="exampleInputUsername1" class="form-label">Username</label>
                                          <input type="text" class="form-control" value="{{$profileData->username}}" name="username" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputName1" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{$profileData->name}}" id="exampleInputName1" autocomplete="off" placeholder="Name">
                                    </div>
                                      <div class="mb-3">
                                          <label for="exampleInputEmail1" class="form-label">Email address</label>
                                          <input type="email" name="email" class="form-control" value="{{$profileData->email}}" id="exampleInputEmail1" placeholder="Email">
                                      </div>
                                      {{-- <div class="mb-3">
                                          <label for="exampleInputPassword1" class="form-label">Password</label>
                                          <input type="password" name="password" class="form-control"  id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                                      </div> --}}
                                                                      
                                      <div class="mb-3">
                                        <label for="eexampleInputAddress1" class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{$profileData->address}}" id="exampleInputAddress1" autocomplete="off" placeholder="Address">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPhone1" class="form-label">phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{$profileData->phone}}" id="exampleInputPhone1" autocomplete="off" placeholder="Phone">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="formFile">Photo</label>
                                        <input class="form-control" name="photo" type="file" id="image">  
                                        <img class="wd-80 rounded-circle mt-2" id="showImage"
                                       src="
                                     {{(!empty($profileData->photo)) 
                                     ? url($profileData->photo) : url('upload/no_image.jpg')
                
                                       }}" 
                                      alt="profile">
                                      </div> 
                                      
                                    
                                      {{-- <div class="form-check mb-3">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                          <label class="form-check-label" for="exampleCheck1">
                                              Remember me
                                          </label>
                                      </div> --}}
                                      <button type="submit" class="btn btn-primary me-3">Save Changes</button>
                                      {{-- <button href="{{route('Admin_Dashboard')}}" class="btn btn-secondary">Cancel</button> --}}
                                  </form>
  
                </div>
              </div>
            
          </div>
          
        </div>
      </div> 
       {{-- <div class="col-md-8 col-xl-6 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">1 min ago</p>
                    </div>
                  </div>
                  <div class="dropdown">
                    <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="meh" class="icon-sm me-2"></i> <span class="">Unfollow</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="corner-right-up" class="icon-sm me-2"></i> <span class="">Go to post</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="share-2" class="icon-sm me-2"></i> <span class="">Share</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="copy" class="icon-sm me-2"></i> <span class="">Copy link</span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus minima delectus nemo unde quae recusandae assumenda.</p>
                <img class="img-fluid" src="https://via.placeholder.com/689x430" alt="">
              </div>
              <div class="card-footer">
                <div class="d-flex post-actions">
                  <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                    <i class="icon-md" data-feather="heart"></i>
                    <p class="d-none d-md-block ms-2">Like</p>
                  </a>
                  <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                    <i class="icon-md" data-feather="message-square"></i>
                    <p class="d-none d-md-block ms-2">Comment</p>
                  </a>
                  <a href="javascript:;" class="d-flex align-items-center text-muted">
                    <i class="icon-md" data-feather="share"></i>
                    <p class="d-none d-md-block ms-2">Share</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card rounded">
              <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">													
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">5 min ago</p>
                    </div>
                  </div>
                  <div class="dropdown">
                    <a type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="meh" class="icon-sm me-2"></i> <span class="">Unfollow</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="corner-right-up" class="icon-sm me-2"></i> <span class="">Go to post</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="share-2" class="icon-sm me-2"></i> <span class="">Share</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="copy" class="icon-sm me-2"></i> <span class="">Copy link</span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <img class="img-fluid" src="https://via.placeholder.com/689x430" alt="">
              </div>
              <div class="card-footer">
                <div class="d-flex post-actions">
                  <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                    <i class="icon-md" data-feather="heart"></i>
                    <p class="d-none d-md-block ms-2">Like</p>
                  </a>
                  <a href="javascript:;" class="d-flex align-items-center text-muted me-4">
                    <i class="icon-md" data-feather="message-square"></i>
                    <p class="d-none d-md-block ms-2">Comment</p>
                  </a>
                  <a href="javascript:;" class="d-flex align-items-center text-muted">
                    <i class="icon-md" data-feather="share"></i>
                    <p class="d-none d-md-block ms-2">Share</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  --}}
      <!-- middle wrapper end -->
      <!-- right wrapper start -->
      {{-- <div class="d-none d-xl-block col-xl-3">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-body">
                <h6 class="card-title">latest photos</h6>
                <div class="row ms-0 me-0">
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-2">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-2">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-2">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-2">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-2">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-2">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-0">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-0">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                  <a href="javascript:;" class="col-md-4 ps-1 pe-1">
                    <figure class="mb-0">
                      <img class="img-fluid rounded" src="https://via.placeholder.com/96x96" alt="">
                    </figure>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 grid-margin">
            <div class="card rounded">
              <div class="card-body">
                <h6 class="card-title">suggestions for you</h6>
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                  <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">											
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">12 Mutual Friends</p>
                    </div>
                  </div>
                  <button class="btn btn-icon border-0"><i data-feather="user-plus"></i></button>
                </div>
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                  <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">											
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">12 Mutual Friends</p>
                    </div>
                  </div>
                  <button class="btn btn-icon border-0"><i data-feather="user-plus"></i></button>
                </div>
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                  <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">											
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">12 Mutual Friends</p>
                    </div>
                  </div>
                  <button class="btn btn-icon border-0"><i data-feather="user-plus"></i></button>
                </div>
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                  <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">											
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">12 Mutual Friends</p>
                    </div>
                  </div>
                  <button class="btn btn-icon border-0"><i data-feather="user-plus"></i></button>
                </div>
                <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                  <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">											
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">12 Mutual Friends</p>
                    </div>
                  </div>
                  <button class="btn btn-icon border-0"><i data-feather="user-plus"></i></button>
                </div>
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-center hover-pointer">
                    <img class="img-xs rounded-circle" src="https://via.placeholder.com/37x37" alt="">											
                    <div class="ms-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">12 Mutual Friends</p>
                    </div>
                  </div>
                  <button class="btn btn-icon border-0"><i data-feather="user-plus"></i></button>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- right wrapper end -->
    </div>

        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#image').change(function(e){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#showImage').attr('src',e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        
        
        </script>
@endsection