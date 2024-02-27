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
  
                                  <h6 class="card-title"> Update Amenitie </h6>
  
                                  <form  id="myForm" class="forms-sample" method="post"
                                   action="{{route('update.amenitie',$amenitie->id)}}">

                                   @csrf

                                   {{-- <input type="hidden" value="{{$amenitie->id}}" > --}}
                                     
                                      <div class="mb-3">
                                          <label for="exampleInputPassword1" class="form-label">Amenitie Name</label>
                                          <input type="text" name="amenitie_name" class="form-control" value="{{$amenitie->amenitie_name}}">

                                      </div>
                                     
                                   
                                    
                                      
                                      
                                     <button type="submit" class="btn btn-primary me-3">Update Amenitie</button>
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
              amenitie_name: {
                  required : true,
              },
              
          },
          messages :{
              amenitie_name: {
                  required : 'Please Enter Amenities Name',
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
@endsection