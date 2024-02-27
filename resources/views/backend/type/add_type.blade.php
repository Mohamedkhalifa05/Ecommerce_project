@extends("admin.admin_dashboard")
@php
$id = Auth::id();
$userData = App\Models\User::findOrFail($id);
@endphp
@section('title')
{{$userData->name}}
@endsection

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<div class="page-content">

   
    <div class="row profile-body">
      <!-- left wrapper start -->
    
      
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">


            <div class="card">
                <div class="card-body">
  
                                  <h6 class="card-title"> Add Property Type </h6>
  
                                  <form class="forms-sample" method="post"
                                   action="{{route('store.type')}}">

                                   @csrf
                                     
                                      <div class="mb-3">
                                          <label for="exampleInputPassword1" class="form-label">Type Name</label>
                                          <input type="text" name="type_name" class="form-control 
                                          @error('type_name') isinvalid  @enderror"  
                                          id="type_name" autocomplete="off" placeholder="Type Name">
                                          @error('type_name')
                                              <span class="text-danger">{{$message}}</span>
                                          @enderror
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Type Icon</label>
                                        <input type="text" name="type_icon" class="form-control 
                                        @error('type_icon') isinvalid  @enderror"  
                                        id="type_icon" autocomplete="off" placeholder="Type Icon">
                                        @error('type_icon')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                      </div>
                                   
                                    
                                      
                                      
                                     <button type="submit" class="btn btn-primary me-3">Add Property Type</button>
                                  </form>
  
                </div>
              </div>
            
          </div>
          
        </div>
      </div> 
    </div>
      
</div>
@endsection