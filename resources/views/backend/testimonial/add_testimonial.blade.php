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
  
                                  <h6 class="card-title"> Add Testimonial </h6>
  
                                  <form class="forms-sample" method="post"
                                   action="{{route('store.testimonial')}}" enctype="multipart/form-data">

                                   @csrf
                                     
                                      <div class="mb-3">
                                          <label for="exampleInputPassword1" class="form-label">Name</label>
                                          <input type="text" name="name"  id="name" autocomplete="off"
                                          class="form-control
                                          @error('name') isinvalid  @enderror"  placeholder="Enter Name">
                                          @error('name')
                                          <span class="text-danger mb-1">{{$message}}</span>
                                      @enderror
                                          
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Position</label>
                                        <input type="text" name="position"  id="position" autocomplete="off"
                                        class="form-control
                                        @error('position') isinvalid  @enderror"  placeholder="Enter position">
                                          @error('position')
                                        <span class="text-danger mb-1">{{$message}}</span>
                                    @enderror
                                        
                                    </div>
                                    <div class="mb-3">
                                      <label for="exampleInputPassword1" class="form-label">Message</label>
                                      <textarea class="form-control" 
                                      id="exampleFormControlTextarea1" name="message" placeholder="Enter Your Message"
                                      @error('message') isinvalid @enderror
                                       rows="3"></textarea>

                                      @error('message')
                                      <span class="text-danger mb-1">{{$message}}</span>
                                  @enderror
                                      
                                  </div>


                                      <div class="mb-3">
                                        <label class="form-label" for="formFile">Image</label>
                                        <input class="form-control
                                        @error('image') isinvalid  @enderror" 
                                        name="image" 
                                         type="file" id="image"> 
                                        @error('image')
                                        <span class="text-danger m-1">{{$message}}</span>
                                         @enderror 
                                      
                                      <img  style ="display:block"class="wd-80 rounded-circle mt-2" id="showImage"
                                      src="
                                    {{ url('upload/no_image.jpg')}}" 
                                     alt="profile">
                                      
                                      
                                     
                                      </div> 
                                      

                                     
                                   
                                    
                                      
                                      
                                     <button type="submit" class="btn btn-primary me-3">Add Testimonial</button>
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