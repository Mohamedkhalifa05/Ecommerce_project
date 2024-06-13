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
  
                                  <h6 class="card-title"> Edit State </h6>
  
                                  <form class="forms-sample" method="post"
                                   action="{{route('update.state')}}" enctype="multipart/form-data">

                                   @csrf


                                   <input type="hidden" name="state_id" value="{{$state->id}}">
                                     
                                      <div class="mb-3">
                                          <label for="exampleInputPassword1" class="form-label">State Name</label>
                                          <input type="text" name="state_name" value="{{$state->state_name}}"  id="state_name" autocomplete="off"
                                          class="form-control
                                          @error('state_name') isinvalid  @enderror"  placeholder="State Name">
                                          @error('state_name')
                                          <span class="text-danger mb-1">{{$message}}</span>
                                      @enderror
                                          
                                      </div>

                                      <div class="mb-3">
                                        <label class="form-label" for="formFile">State Image</label>
                                        <input class="form-control
                                        @error('state_image') isinvalid  @enderror" 
                                        name="state_image" 
                                         type="file" id="state_image"> 
                                        @error('state_image')
                                        <span class="text-danger m-1">{{$message}}</span>
                                         @enderror 
                                      
                                      <img  style ="display:block"class="wd-80 rounded-circle mt-2" id="showImage"
                                      {{-- src="
                                    {{ url('upload/no_image.jpg')}}"  --}}
                                    src="{{asset($state->state_image)}}"
                                     alt="profile">
                                      
                                      
                                     
                                      </div> 
                                      

                                     
                                   
                                    
                                      
                                      
                                     <button type="submit" class="btn btn-primary me-3">Update State</button>
                                  </form>
  
                </div>
              </div>
            
          </div>
          
        </div>
      </div> 
    </div>
      
</div>


<script type="text/javascript">
  $(document).ready(function(){
      $('#state_image').change(function(e){
          var reader = new FileReader();
          reader.onload = function(e){
              $('#showImage').attr('src',e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
      });
  });


</script>
@endsection