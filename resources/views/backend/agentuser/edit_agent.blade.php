@extends("admin.admin_dashboard")

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


            <div class="card" >
                <div class="card-body">
  
                                  <h6 class="card-title"> Edit Agent </h6>

                                  <form id="myForm" method="POST" action="{{ route('update.agent') }}" class="forms-sample" enctype="multipart/form-data">
  
                                  {{-- <form class="forms-sample" method="post"
                                   action="{{route('store.amenitie')}}"> --}}

                                   @csrf

                                   <input type="hidden" name="id" value="{{$agent->id}}">
                                     
                                      <div class=" form-group mb-3">
                                          <label for="exampleInputPassword1" class="form-label">Agent Name</label>
                                          <input type="text" name="name" value="{{$agent->name}}" class="form-control" >
                                          {{-- <input type="text" name="amenitie_name" class="form-control 
                                          @error('amenitie_name') isinvalid  @enderror"  
                                          id="amenitie_name" autocomplete="off" placeholder="Amenitie Name">
                                          @error('amenitie_name')
                                              <span class="text-danger">{{$message}}</span>
                                          @enderror --}}
                                          
					 
                                      </div>
                                      <div class=" form-group mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Agent Username</label>
                                        <input type="text" name="username" value="{{$agent->username}}"  class="form-control" >
                                
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Agent Email</label>
                                        <input type="text" name="email" value="{{$agent->email}}"  class="form-control" autocomplete="off" >
                                
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Agent Password</label>
                                        <input type="password" name="password" autocomplete="off" class="form-control" >
                                
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Agent Phone</label>
                                        <input type="text" name="phone" value="{{$agent->phone}}"  class="form-control" autocomplete="off" >
                                
                                    </div>
                                    <div class=" form-group mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Agent Address</label>
                                        <input type="text" name="address" value="{{$agent->address}}"  class="form-control" >
                                
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Agent Status</label>
                                        <select name="status" id="status" class="form-control">
                                              {{-- <option value="" disabled>Select Agent Status</option> --}}
                                              <option value="active"{{$agent->status == 'active' ? "selected" : ""}}>Active</option>
                                              <option value="inactive" {{$agent->status == 'inactive' ? "selected" : ""}}>Inactive</option>

                                              
                                        </select>
                                     </div>
                                     <div class="row mb-3">

                                        <div class="form-group col-md-8">
                                          <label class="form-label">Agent Image </label>
                                          <input type="file" name="photo" class="form-control" onChange="mainThamUrl(this)"  >
                          
                                          <img src="" id="mainThmb">
                          
                                        </div>
                                      
                                        <div class="form-group col-md-4">
                                          <label class="form-label"></label>
                                          
                          
                                          <img src="{{ (!empty($agent->photo)) ? asset($agent->photo) : url('upload/no_image.jpg')}}" style="width: 100px;height:100px" >
                          
                                        </div>
                                      </div><!-- Col -->
                                   
                                    
                                      
                                      <br><br>
                                     <button type="submit" class="btn btn-primary me-3">Save Changes</button>
                                  </form>
  
                </div>
              </div>
            
          </div>
          
        </div>
      </div> 
    </div>
      
</div>

<script type="text/javascript">
  $(document).ready(function (){
      $('#myForm').validate({
          rules: {
              name: {
                  required : true,
              },
              username: {
                  required : true,
              },
              email: {
                  required : true,
              },
              password: {
                  required : true,
              },
              phone: {
                  required : true,
              },
              address: {
                  required : true,
              },
              photo: {
                  required : true,
              },
              
          },
          messages :{
              name: {
                  required : 'Please Enter Agent Name',
              }, 
              username: {
                  required : 'Please Enter Agent Username',
              }, 
              email: {
                  required : 'Please Enter Agent Email',
              }, 
              password: {
                  required : 'Please Enter Agent Password',
              }, 
              phone: {
                  required : 'Please Enter Agent Phone',
              },
              address: {
                  required : 'Please Enter Agent Address',
              },
              photo: {
                  required : 'Please Enter Agent Image',
              }, 
               
          },
          errorElement : 'span', 
          errorPlacement: function (error,element) {
              error.addClass('invalid-feedback');
              element.closest('.form-group').append(error);
          },
          highlight : function(element, errorClass, validClass){
              $(element).addClass('is-invalid');
          },
          unhighlight : function(element, errorClass, validClass){
              $(element).removeClass('is-invalid');
          },
      });
  });
  
</script>

<script type="text/javascript">
    function mainThamUrl(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
              $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    } 
 </script>

@endsection